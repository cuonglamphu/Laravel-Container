<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Registration') }}
        </h2>
    </x-slot>
    <!-- Toats -->
    <div id="toast-success" class="toast hidden flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">Congrats ! your category is added ️🎉</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form>
                    <div class="p-6 text-gray-900">
                        <div class="p-6 text-gray-900 grid md:grid-cols-3">
                            <div class="md:col-start-2 col-span-1">

                                <div class="flex justify-center">
                                    <h1 class="flex items-center font-sans font-bold break-normal text-yellow-500 py-4 text-xl md:text-2xl">
                                        Category Registration
                                    </h1>
                                    <hr>
                                </div>
                                <div class="relative z-0 mb-5 group">


                                    <label id="floating_Category_Name_Lable" for="floating_Category_Name" class="font-bold"> {{ __("Category Name") }}</label>
                                    <input type="text" id="floating_Category_Name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-violet-500 focus:border-yellow-500 focus:ring-yellow-500  focus:shadow-yellow-500 mt-2" placeholder="Enter category name">

                                    <!-- /handle erro -->
                                    <div id="notice" class="text-red-500 mt-1 hidden text-xl italic">{{__("Category name is required")}}</div>
                                </div>
                            </div>

                        </div>
                        <div>
                            <button id="submitBtn" type="submit" class="relative float-right mb-5 rounded px-4 py-2 overflow-hidden group bg-yellow-400 relative hover:bg-gradient-to-r hover:from-yellow-400 hover:to-yello-300 text-white hover:ring-2 hover:ring-offset-2 hover:ring-violet-950 transition-all ease-out duration-300">
                                <span class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                                <span id="submitLable" class="relative">{{ __("Submit") }}</span>
                                <div id="spinner" class="mx-auto  h-6 w-6 animate-spin rounded-full border-b-2 border-current" />
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            hideSpinner();
            //remove error message
            $('#floating_Category_Name').focus(function() {
                $('#notice').removeClass('block');
                $('#notice').removeClass('text-green-500');
                $('#notice').addClass('hidden');
                $('#floating_Category_Name').removeClass('border-red-500');
                $('#floating_Category_Name').addClass('border-gray-300');
                $('#floating_Category_Name_Lable').removeClass('text-red-500');
                $('#floating_Category_Name_Lable').addClass('text-gray-500');
            });

            $('form').submit(function(e) {
                e.preventDefault();
                showSpinner();
                var Category_Name = $('#floating_Category_Name').val();
                $.ajax({
                    url: "{{ route('categories.store') }}",
                    type: "POST",
                    data: {
                        Category_Name: Category_Name,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {

                        if (response.success == true && response.message == "Category created successfully") {
                            hideSpinner();
                            //clear input
                            $('#floating_Category_Name').val('');
                            //show toast
                            showToast('#toast-success');
                        } else {
                            hideSpinner();
                            //chang color of label and input
                            $('#floating_Category_Name').addClass('border-red-500');
                            $('#floating_Category_Name').removeClass('border-gray-300');
                            $('#floating_Category_Name_Lable').addClass('text-red-500');
                            $('#floating_Category_Name_Lable').removeClass('text-gray-500');
                            //show error message
                            $('#notice').removeClass('hidden').addClass('block text-red-500').text(response.data.Category_Name[0]);
                        }
                    },
                    error: function(response) {
                        hideSpinner();
                        console.log(response);
                    }
                });
            });
        })
    </script>
</x-app-layout>