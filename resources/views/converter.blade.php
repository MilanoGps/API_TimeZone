<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Zone Converter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-200 min-h-screen flex items-center justify-center px-3">

    <div class="w-full max-w-lg">
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 transition-transform hover:scale-[1.01] duration-200">
            <h1 class="text-3xl font-extrabold text-purple-400 text-center mb-6">Time Zone Converter</h1>

            {{-- Form --}}
            <form method="POST" action="{{ route('timezone.convert') }}" class="grid gap-6">
                @csrf

                <div>
                    <label class="block text-gray-300 font-semibold mb-2">Datetime</label>
                    <input type="datetime-local" name="datetime" required
                        value="{{ old('datetime') }}"
                        class="w-full px-4 py-3 border border-gray-600 bg-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-400 text-lg transition-all" />
                </div>

                <div>
                    <label class="block text-gray-300 font-semibold mb-2">From Timezone</label>
                    <select name="from_timezone" required
                        class="w-full px-4 py-3 border border-gray-600 bg-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-400 text-lg transition-all">
                        @foreach($timezones as $tz)
                            <option value="{{ $tz }}" {{ old('from_timezone') == $tz ? 'selected' : '' }}>
                                {{ $tz }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-300 font-semibold mb-2">To Timezone</label>
                    <select name="to_timezone" required
                        class="w-full px-4 py-3 border border-gray-600 bg-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-400 text-lg transition-all">
                        @foreach($timezones as $tz)
                            <option value="{{ $tz }}" {{ old('to_timezone') == $tz ? 'selected' : '' }}>
                                {{ $tz }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-purple-600 to-pink-500 text-white font-bold py-3 rounded-xl shadow-lg hover:from-purple-700 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-400 text-lg transition-all">
                    Convert
                </button>
            </form>

            @if(session('result'))
                <div class="mt-8 bg-gray-700 border-l-4 border-purple-400 p-5 rounded-xl shadow">
                    <h3 class="text-xl font-bold text-purple-300 mb-3">🔎 Conversion Result</h3>
                    <div class="space-y-2">
                        <p class="text-lg">
                            <span class="text-gray-400">Input:</span>
                            <strong class="text-white">{{ session('input_datetime') }}</strong>
                            <span class="text-purple-300">({{ session('from') }})</span>
                        </p>
                        <p class="text-lg">
                            <span class="text-gray-400">Converted:</span>
                            <strong class="text-white">{{ session('result') }}</strong>
                            <span class="text-purple-300">({{ session('to') }})</span>
                        </p>
                    </div>
                </div>
            @endif
        </div>

        <div class="mt-6 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Aditya Meilano | IS 06-01 | IAE
        </div>
    </div>
</body>
</html>
