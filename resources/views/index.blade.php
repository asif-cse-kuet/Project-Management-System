<section>

    <!-- login and register form -->
    <div class="float-center w-full bg-orange-50 flex justify-center">
        <div class="m-6 my-20 p-10 flex justify-center w-[60%] bg-gray-100 rounded">
            <div class="w-[100%] flex justify-center">
                <!--login Start -->
                <form id="loginForm" action="{{ route('login') }}" method="POST" class="mr-12 w-auto">
                    @csrf
                    <div>
                        @error('login')
                        <span class="text-red-500 text-sm">{{$message}}</span>
                        @enderror
                        <label for="email">Email</label><br>
                        <input type="email" id="email" name="email" class="my-2 mr-2 w-full rounded" required>
                    </div>
                    <div>
                        <label for="password">Password</label><br>
                        <input type="password" id="password" name="password" class="my-2 mr-2 w-full rounded" required>
                    </div>
                    <div>
                        <label for="role">Role</label><br>
                        <select class="rounded w-full" id="role" name="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" id="submitBtn" class="bg-green-200 p-1 w-full rounded my-5">Login</button>
                    </div>

                </form>

                <!-- Login End -->
            </div>

            <br><br>

            <div class="w-[100%] flex justify-center">
                <!--Register Form Start -->
                <form id="registerForm" action="{{ route('register') }}" method="POST" class="ml-12 w-auto">
                    @csrf
                    <div>
                        <div>
                            <label for="fname">First Name</label><br>
                            <input type="text" id="fname" name="fname" class="my-2 mr-2 w-full rounded" required>
                            @error('fname')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="lname">Last Name</label><br>
                            <input type="text" id="lname" name="lname" class="my-2 mr-2 w-full rounded" required>
                            @error('lname')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for=" email">Email</label><br>
                            <input type="email" id="email" name="email" class="my-2 mr-2 w-full rounded" required>
                            @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for=" password">Password</label><br>
                            <input type="password" id="password" name="password" class="my-2 mr-2 w-full rounded" required>
                            @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for=" password_confirmation">Confirm Password</label><br>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="my-2 mr-2 w-full rounded" required>
                        </div>
                        <div>
                            <label for="role">Role</label><br>
                            <select class="rounded w-full" id="role" name="role">
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" id="submitBtn" class="bg-green-200 p-1 w-full rounded my-5">Register</button>
                        </div>
                    </div>
                </form>
                <!-- Register Form end -->
            </div>
        </div>
    </div>

</section>