<div class="lg:col-span-2">
    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
        <div class="md:col-span-1">
            <label for="salutation">Title</label>
            <select name="salutation" id="salutation" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                <option value="Mr.">Mr.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Ms.">Ms.</option>
            </select>
        </div>
        <div class="md:col-span-2">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ old('first_name') }}" />
        </div>
        <div class="md:col-span-2">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ old('last_name') }}" />
        </div>
    </div>

    <div class="md:col-span-5 mt-5">
        <label for="email">Email Address</label>
        <input type="text" name="email" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ old('email') }}" placeholder="email@domain.com" />
    </div>

    <div class="md:col-span-3 mt-5">
        <label for="address">Address / Street</label>
        <input type="text" name="address" id="address" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ old('address') }}" placeholder="" />
    </div>

    <div class="md:col-span-2 mt-5">
        <label for="city">City</label>
        <input type="text" name="city" id="city" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ old('city') }}" placeholder="" />
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
        <label for="state">State / province</label>
        <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
            <input name="state" id="state" placeholder="State" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" />
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
        <input type="text" name="zipcode" id="zipcode" class="transition-all flex items-center h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="" value="" />
    </div>

    <div class="md:col-span-5  mt-5">
        <div class="inline-flex items-center">
            <input type="checkbox" name="billing_same" id="billing_same" class="form-checkbox" />
            <label for="billing_same" class="ml-2">My billing address is different than above.</label>
        </div>
    </div>
    <div class="md:col-span-5 text-right  mt-5">
        <div class="inline-flex items-end">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
        </div>
    </div>

</div>
