@include('layouts.delegateheader')
@include('layouts.delegate_navbar')

<div class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8" style="
    padding-top: 20px;">
    <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
        <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">

        </div>

    </div>
{{--    @include('delegate.card')--}}
    <form action="{{ route('delegate.submit') }}" method="POST" class="" style="margin-top: 20px;">
        @csrf

        <!-- <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center"> -->

        <div class="container max-w-screen-lg mx-auto">
            <div>
                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6 mt-5">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Provide required information for registration</p>
                            <p>Please fill out all the fields.</p>
                        </div>

                        <div class="lg:col-span-2">

                            <div class="md:col-span-1">
                                <label for="sector">Select Industry Sector</label>
                                <select name="sector" id="sector" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                    <option value=""> --Select Industry Sector-- </option>
                                    @foreach ($sector as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="md:col-span-5 mt-5">
                                <label for="organisation_type">Organisation Type</label>
                                <select name="organisation_type" id="organisation_type" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                    <option value=""> -- Select Organisation Type -- </option>
                                    @foreach ($organisation as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="md:col-span-3 mt-5">
                                <div class="md:col-span-3 mt-5"></div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="delegates">Number of Delegates</label>
                                        <div class="flex items-center mt-1">
                                            <select name="delegates" id="delegates" class="h-10 border mt-1 rounded px-2 w-full bg-gray-50">
                                                @for ($i = 1; $i <= $delegates; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select></div>
                                    </div>
                                    <div>
                                        <label>Category</label>
                                        <div class="flex items-center mt-1">
                                            <input type="radio" id="indian" name="category" value="Indian" class="h-5 w-5 text-gray-600 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked>
                                            <label for="indian" class="ml-2">Indian</label>
                                        </div>
                                        <div class="flex items-center mt-1">
                                            <input type="radio" id="international" name="category" value="International" class="h-5 w-5 text-gray-600 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            <label for="international" class="ml-2">International</label>
                                        </div>
                                    </div>
                                    <div style="display: none">
                                        <label for="delegates">Enter TiE Global Membership ID</label>
                                        <!-- Enter TiE Global Membership ID -->
                                        <input type="text" name="tie_global_membership_id" id="tie_global_membership_id" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ old('tie_global_membership_id') }}" />

                                    </div>

                                </div>
                                @if (session('zohoApiIntegrationResult'))
                                    @php
                                        $response = session('zohoApiIntegrationResult');
                                        $id = $response['0'];
                                        $chapter_name = $response[1];
                                        $membershipType = $response[2];
                                    @endphp
                                <br>
                                <br>
                                    <div class="bg-white p-6 rounded shadow-md w-full">                                            <p class="text-gray-700 font-semibold">Membership ID: <span class="text-black">{{ $id }}</span></p>
                                        <p class="text-gray-700 font-semibold mt-2">Chapter Name: <span class="text-black">{{ $chapter_name }}</span></p>
                                        <p class="text-gray-700 font-semibold mt-2">Membership Type: <span class="text-black">{{ $membershipType }}</span></p>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>


            </div>
<!--
            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6 mt-5">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-gray-600">
                        <p class="font-medium text-lg">Provide Organisation Information</p>
                        <p>Please fill out all the required fields.</p>
                    </div>

                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                            <div class="md:col-span-5 mt-5">
                                <label for="org_name">Organisation Name</label>
                                <input type="text" name="org_name" id="org_name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ old('org_name') }}" />
                            </div>

                        </div>

                        <div class="md:col-span-2 mt-5">
                            <label for="country">Country / region</label>
                            <div class="h-10 bg-gray-50 flex rounded items-center mt-1">
                                <select name="country" id="country" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                    <option value="">Select Country</option>

                                    @foreach ($countries as $country)
                                        <option value="{{ $country }}">{{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="md:col-span-2 mt-5">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ old('city') }}" placeholder="" />
                        </div>

                        <div class="md:col-span-2 mt-5">
                            <label for="mobile">Contact Number</label>
{{--                            <x-icon name="flag-country-{{ $country->countryCode }}" />--}}



                            <input type="text" id="mobile_code" name="mobile" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ old('mobile') }}" placeholder="Contact Number">
                        </div>



                        <div class="md:col-span-2 mt-5">
                            <label for="state">State / province</label>
                            <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                <input name="state" id="state" placeholder="State" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="{{old('state')}}" />
                                <button tabindex="-1" class="cursor-pointer outline-none focus:outline-none transition-all text-gray-300 hover:text-red-600">
                                    <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                                <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-300 hover:text-blue-600">
                                    <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="18 15 12 9 6 15"></polyline>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="md:col-span-1  mt-5">
                            <label for="zipcode">Zipcode</label>
                            <input type="text" name="zipcode" id="zipcode" class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="" value="{{old('zipcode')}}" />
                        </div>

                        <div class="md:col-span-1 mt-5" style="display: flex; align-items: center; gap: 10px;">
                            <label for="captcha">Captcha</label>
                            <input type="text" name="captcha" id="captcha" class="transition-all flex items-center h-10 border mt-1 rounded px-4 bg-gray-50" placeholder="">
                            <img src="{{ captcha_src('default') }}" alt="captcha">
                        </div>
                        -->
                        <div class="md:col-span-5 text-right  mt-5">
                            <div class="inline-flex items-end">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                            </div>
                        </div>

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}


        </div>

    </form>
</div>

<script>
    //if Organisation Type is TiE Global then show the Tie Global Membership ID
    document.getElementById('organisation_type').addEventListener('change', function() {
        let org_type = document.getElementById('organisation_type').value;
        let tieGlobalMembershipId = document.getElementById('tie_global_membership_id');
        if (org_type === 'TiE Global') {
            tieGlobalMembershipId.value = '';
            tieGlobalMembershipId.parentElement.style.display = 'block';
        } else {
            //insert into input as N/A
            tieGlobalMembershipId.value = 'N/A';
            tieGlobalMembershipId.parentElement.style.display = 'none';
        }
    });



        function decreaseDelegates() {
        let delegatesInput = document.getElementById('delegates');
        let currentDelegates = parseInt(delegatesInput.value);
        if (currentDelegates > 1) {
        delegatesInput.value = currentDelegates - 1;
    }
    }

        function increaseDelegates() {
        let delegatesInput = document.getElementById('delegates');
        let currentDelegates = parseInt(delegatesInput.value);
        let maxDelegates = <?php echo $delegates; ?>;
        if (currentDelegates < maxDelegates) {
        delegatesInput.value = currentDelegates + 1;
    }
    }


</script>
