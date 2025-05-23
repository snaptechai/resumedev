<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('package')->where('id', 1)->update([
            'title' => 'Career Starter',
            'price' => 169,
            'is_popular' => 0,
            'short_description' => '<p>Kick off the job search with a keyword-optimized, ATS-friendly resume.</p>',
            'full_description' => '<ul>
<li>Keyword optimized resume</li><li>ATS-friendly, modern resume format.</li><li>Professional resume critique</li><li>Editable and PDF versions.</li><li>48-hour turnaround time.</li></ul>',
            'duration' => 48,
            'europe_price' => 40,
            'old_price' => 200,
            'europe_old_price' => 50,
        ]);

        DB::table('package')->where('id', 2)->update([
            'title' => 'Professional Edge',
            'price' => 229,
            'is_popular' => 1,
            'short_description' => '<p>Improve your visibility and impact with a winning resume and compelling cover letter.</p>',
            'full_description' => '<ul><li>Personalized cover letter.</li><li>Keyword-optimized resume.</li><li>ATS-friendly, modern formats.</li><li>Editable and PDF versions</li><li>48-hour turnaround time</li></ul>',
            'duration' => 48,
            'europe_price' => 50,
            'old_price' => 300,
            'europe_old_price' => 60,
        ]);

        DB::table('package')->where('id', 3)->update([
            'title' => 'Executive Boost',
            'price' => 369,
            'is_popular' => 0,
            'short_description' => '<p>Receive a compelling resume, cover letter, and LinkedIn profile for memorable job applications.</p>',
            'full_description' => '<ul><li>LinkedIn profile optimization.</li><li>Personalized resume & cover letter.</li><li>ATS-friendly, modern formats.</li><li>Editable and PDF versions</li><li>48-hour turnaround time</li></ul>',
            'duration' => 48,
            'europe_price' => 60,
            'old_price' => 400,
            'europe_old_price' => 70,
        ]);

        DB::table('package')->where('id', 4)->update([
            'title' => 'Build Your Own Package',
            'price' => 60,
            'is_popular' => 0,
            'short_description' => 'Build your own job search suite with multiple resumes, cover letters, and LinkedIn profiles.',
            'full_description' => '',
            'duration' => 0,
            'europe_price' => 20,
            'old_price' => 100,
            'europe_old_price' => null,
        ]);

        DB::table('package')->where('id', 5)->delete();
    }
}
