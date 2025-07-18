<?php

namespace App\Jobs;

use App\Models\AiReview;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Prism\Prism\Prism;
use Prism\Prism\Enums\Provider;
use Prism\Prism\ValueObjects\Messages\SystemMessage;
use Prism\Prism\ValueObjects\Messages\UserMessage;
use Illuminate\Support\Facades\Http;
use Prism\Prism\ValueObjects\Media\OpenAIFile;
use PhpOffice\PhpWord\IOFactory;

class ProcessAiResumeReview implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 300;
    public $backoff = [60, 120, 180];

    public function __construct(
        private AiReview $aiReview
    ) {}

    public function handle(): void
    {
        try {
            $systemPrompt = "You are a professional resume reviewer working on behalf of a resume writing company. Analyze the uploaded resume and provide a constructive, professional review that subtly encourages the customer to consider professional resume writing services. This is not an email, so do not include a bottom signature block or similar elements. The response should consist of a greeting followed by the review. Your critique should focus on: Greeting: Start with a professional and friendly greeting using the customer's name from the resume. Overall Presentation: Highlight areas where the design, formatting, layout, or margins could be improved to make the resume more polished and professional. Content Effectiveness: Identify sections that could benefit from clearer phrasing, more compelling language, or better descriptions of skills and experience. Achievements and Metrics: Stress the importance of quantifying achievements and demonstrating measurable impact, suggesting that adding metrics would significantly enhance the resume if absent. Alignment with Industry Standards: Comment on the resume's ability to stand out in a competitive job market and note areas where it may lack specific tailoring or professional refinement. Overall Impression: Conclude positively, but highlight how professional assistance could transform the resume into a more compelling and effective document. Frame your feedback to acknowledge the user's effort while emphasizing how professional services can boost their success. The response should be in clean, easy-to-read HTML format, intended for placement within a <div> tag for PDF generation, using only inline text decorations (e.g., <b>, <u>, <i>), structural elements like <ul> or <ol> for lists, and margins for spacing applied to child elements only, not the parent <div>, without color changes. Use typographical decorations sparingly, only when necessary to enhance readability, and always prioritize a clean, professional presentation.";

            $fullPath = Storage::disk('public')->path($this->aiReview->file_path);
            $fileExtension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));

            Log::info('Processing AI Resume Review', [
                'ai_review_id' => $this->aiReview->id,
                'file_path' => $fullPath,
                'file_extension' => $fileExtension
            ]);

            if ($fileExtension === 'pdf') {
                $fileId = $this->uploadFileToOpenAI($fullPath);

                $response = Prism::text()
                    ->using(Provider::OpenAI, 'gpt-4o')
                    ->withMessages([
                        new SystemMessage($systemPrompt),
                        new UserMessage('Please review the following resume and provide constructive feedback:', [
                            new OpenAIFile($fileId),
                        ]),
                    ])
                    ->asText();
            } elseif ($fileExtension === 'docx') {
                $extractedText = $this->extractTextFromDocx($fullPath);

                $response = Prism::text()
                    ->using(Provider::OpenAI, 'gpt-4o')
                    ->withMessages([
                        new SystemMessage($systemPrompt),
                        new UserMessage("Please review the following resume content and provide constructive feedback:\n\n" . $extractedText),
                    ])
                    ->asText();
            } else {
                throw new \Exception('Unsupported file format: ' . $fileExtension . '. Only PDF and DOCX files are supported.');
            }

            $this->aiReview->update([
                'description' => $response->text,
                'is_sent' => false
            ]);

            Log::info('AI Resume Review completed successfully', [
                'ai_review_id' => $this->aiReview->id
            ]);
        } catch (\Exception $e) {
            Log::error('AI Resume Review failed', [
                'ai_review_id' => $this->aiReview->id,
                'error' => $e->getMessage(),
                'attempt' => $this->attempts()
            ]);

            throw $e;
        }
    }

    private function extractTextFromDocx(string $filePath): string
    {
        try {
            $phpWord = IOFactory::load($filePath);
            $text = '';

            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    if (method_exists($element, 'getText')) {
                        $text .= $element->getText() . "\n";
                    } elseif (method_exists($element, 'getElements')) {
                        foreach ($element->getElements() as $childElement) {
                            if (method_exists($childElement, 'getText')) {
                                $text .= $childElement->getText() . "\n";
                            } elseif (method_exists($childElement, 'getElements')) {
                                foreach ($childElement->getElements() as $grandChildElement) {
                                    if (method_exists($grandChildElement, 'getText')) {
                                        $text .= $grandChildElement->getText() . "\n";
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $extractedText = trim($text);

            if (strlen($extractedText) < 50) {
                throw new \Exception('Could not extract text from DOCX file.');
            }

            return $extractedText;
        } catch (\Exception $e) {
            Log::error('DOCX text extraction failed', [
                'file_path' => $filePath,
                'error' => $e->getMessage()
            ]);
            throw new \Exception('Failed to extract text from DOCX document: ' . $e->getMessage());
        }
    }

    private function uploadFileToOpenAI(string $filePath): string
    {
        $response = Http::timeout(120)
            ->connectTimeout(30)
            ->withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            ])->attach(
                'file',
                file_get_contents($filePath),
                basename($filePath)
            )->post('https://api.openai.com/v1/files', [
                'purpose' => 'assistants'
            ]);

        if (!$response->successful()) {
            throw new \Exception('Failed to upload file to OpenAI: ' . $response->body());
        }

        return $response->json('id');
    }
}
