<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recover Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
<body>
    <form action="{{ route('recover_Account') }}" method="post">
      @csrf
      <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
          {{-- <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company"> --}}
          <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Recover your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
          <form class="space-y-6" action="#" method="POST">
            <div>
              @if (session('sent_email'))
              <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                <p class="font-bold">Success!</p>
                <p>Check your email for verification.</p>
              </div>
              @endif
              @if (session('invalid_email'))
              <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                <p class="font-bold">Error!</p>
                <p>Invalid Email Address. Please try again</p>
              </div>
              @endif
            </div>
            <div>
              <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Enter your Email address</label>
              <div class="mt-2">
                <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-3">
              </div>
            </div>
      
            <div>
              <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">New Password</label>
              </div>
              <div class="mt-2">
                <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-3">
              </div>
            </div>
      
            <div>
                {{-- <div class="flex items-center justify-between">
                  <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Re-type Password</label>
                </div>
                <div class="mt-2">
                  <input id="retype_password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-3">
                </div> --}}
              </div>
            <div class="mt-4">
              <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Verify My Account</button>
            </div>
          </form>
      
          <p class="mt-10 text-center text-sm text-gray-500">
            Have an account?
            <a href="{{ route('log_in') }}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Log in</a>
          </p>
        </div>
      </div>
    </form>
</body>
</html>