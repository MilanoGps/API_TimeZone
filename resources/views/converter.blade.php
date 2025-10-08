<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Hasil Konversi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-tr from-[#1a001f] via-[#2b0033] to-[#3a004a] min-h-screen flex items-center justify-center px-4 text-gray-100">
  <div class="w-full max-w-lg">
    <div class="bg-white/10 backdrop-blur-md rounded-2xl shadow-2xl p-8 border border-white/20">
      <h1 class="text-3xl text-center font-extrabold text-pink-400 mb-6">🔮 Hasil Konversi</h1>

      @if(!empty($data) && isset($data['toTimestamp']))
        <div class="space-y-4">
          <div class="bg-gradient-to-r from-[#2a0033] to-[#3a004a] p-4 rounded-xl border-l-4 border-pink-500 shadow">
            <p class="text-gray-300 text-sm mb-1">Waktu Asal ({{ $input['from'] }})</p>
            <p class="text-lg font-bold text-pink-300">{{ date('Y-m-d H:i:s', $timestamp) }}</p>
          </div>

          <div class="bg-gradient-to-r from-[#3a004a] to-[#4b005f] p-4 rounded-xl border-l-4 border-purple-500 shadow">
            <p class="text-gray-300 text-sm mb-1">Waktu Tujuan ({{ $input['to'] }})</p>
            <p class="text-lg font-bold text-purple-300">{{ date('Y-m-d H:i:s', $data['toTimestamp']) }}</p>
          </div>
        </div>
      @else
        <p class="text-center text-red-400 font-semibold mt-4">
          ⚠️ Gagal, Coba Lagi.
        </p>
      @endif

      <div class="mt-6 text-center">
        <a href="{{ route('home') }}"
           class="inline-block bg-gradient-to-r from-pink-600 to-purple-600 text-white font-semibold py-2 px-6 rounded-xl shadow-md hover:scale-105 transition-transform duration-150">
           ← Back
        </a>
      </div>
    </div>
  </div>
</body>
</html>
