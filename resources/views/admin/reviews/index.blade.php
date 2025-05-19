<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="px-4 py-3 border-b flex justify-between items-center mb-2">
                <h2 class="text-2xl font-medium text-gray-700">Reviews</h2>
            </div>

            @include('admin.massage-bar')

            <div class="flex border-b" id="tabs">
                <button
                    class="tab-button px-4 py-2 text-sm font-semibold text-gray-700 border-b-2 border-transparent hover:border-green-500"
                    data-tab="pending">Pending Reviews</button>
                <button
                    class="tab-button px-4 py-2 text-sm font-semibold text-gray-700 border-b-2 border-transparent hover:border-green-500"
                    data-tab="approved">Approved Reviews</button>
                <button
                    class="tab-button px-4 py-2 text-sm font-semibold text-gray-700 border-b-2 border-transparent hover:border-green-500"
                    data-tab="rejected">Rejected Reviews</button>

            </div>

            <div id="pending" class="tab-content">
                @include('admin.reviews.review-table', ['reviews' => $pendingReviews, 'status' => 0])
            </div>

            <div id="approved" class="tab-content hidden">
                @include('admin.reviews.review-table', ['reviews' => $approvedReviews, 'status' => 1])
            </div>

            <div id="rejected" class="tab-content hidden">
                @include('admin.reviews.review-table', ['reviews' => $rejectedReviews, 'status' => 2])
            </div>
        </div>
    </div>
</x-layouts.app>

<script>
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', () => {

            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));


            const tabId = button.getAttribute('data-tab');
            document.getElementById(tabId).classList.remove('hidden');


            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('border-green-500');
                btn.classList.remove('bg-green-100');
            });
            button.classList.add('border-green-500');
            button.classList.add('bg-green-100');
        });
    });


    document.querySelector('.tab-button').click();

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".status-dropdown").forEach(function(dropdown) {
            dropdown.addEventListener("change", function() {
                const reviewId = this.getAttribute("data-id");
                const newStatus = this.value;

                const confirmChange = confirm("Are you sure you want to change the status?");
                if (!confirmChange) {
                    location.reload();
                    return;
                }

                fetch(`/review/${reviewId}`, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]').getAttribute("content")
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Status updated successfully.");
                            location.reload();
                        } else {
                            alert("Failed to update status.");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("An error occurred.");
                    });
            });
        });
    });
</script>
