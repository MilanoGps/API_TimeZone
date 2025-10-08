<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konversi Zona Waktu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        select {
            color: white;
            background-color: #2a043d;
        }
        select option {
            background-color: #2a043d;
            color: white;
        }
        select:focus {
            outline: none;
            box-shadow: 0 0 0 2px #ec4899;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-[#1a022d] text-white">

    <div class="bg-[#2a043d]/80 backdrop-blur-md rounded-3xl shadow-2xl p-10 w-[95%] max-w-lg border border-[#b026ff]/30">
        <h1 class="text-3xl font-bold text-center mb-8 flex items-center justify-center gap-2 text-pink-400">
            🔮 Konversi Zona Waktu
        </h1>

        <form id="convertForm" action="{{ route('convert.time') }}" method="POST" class="space-y-7" novalidate>
            @csrf

            <div>
                <label class="block text-base mb-3 text-pink-300 font-semibold">Masukkan Waktu</label>
                <input type="time" name="time" id="time"
                    class="w-full rounded-2xl bg-[#1a022d] text-white px-4 py-3 border border-[#6d28d9]/40 text-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition-all"
                    required>
            </div>

            <div>
                <label class="block text-base mb-3 text-pink-300 font-semibold">Zona Waktu Asal</label>
                <select name="from" id="from"
                    class="w-full rounded-2xl border border-[#6d28d9]/40 px-4 py-3 bg-[#1a022d] text-lg focus:ring-2 focus:ring-pink-500" required>
                    <option value="">-- Pilih Zona Waktu --</option>
                    @foreach ($zones as $zone)
                        <option value="{{ $zone }}">{{ $zone }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-base mb-3 text-pink-300 font-semibold">Zona Waktu Tujuan</label>
                <select name="to" id="to"
                    class="w-full rounded-2xl border border-[#6d28d9]/40 px-4 py-3 bg-[#1a022d] text-lg focus:ring-2 focus:ring-pink-500" required>
                    <option value="">-- Pilih Zona Waktu --</option>
                    @foreach ($zones as $zone)
                        <option value="{{ $zone }}">{{ $zone }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="w-full py-3.5 rounded-2xl font-semibold text-lg text-white bg-gradient-to-r from-pink-600 via-purple-600 to-indigo-600 hover:from-pink-500 hover:to-purple-500 transition-all shadow-lg mt-6">
                🔮 Konversi
            </button>
        </form>
    </div>

    <script>
        document.getElementById('convertForm').addEventListener('submit', function (e) {
            const fields = ['time', 'from', 'to'];
            for (const id of fields) {
                const el = document.getElementById(id);
                el.setCustomValidity('');
                if (!el.value) {
                    if (id === 'time') el.setCustomValidity('Silakan masukkan waktu terlebih dahulu.');
                    if (id === 'from') el.setCustomValidity('Silakan pilih zona waktu asal.');
                    if (id === 'to') el.setCustomValidity('Silakan pilih zona waktu tujuan.');
                    el.reportValidity();
                    e.preventDefault();
                    return;
                }
            }
        });
    </script>

</body>
</html>
