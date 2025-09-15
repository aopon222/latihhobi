<!DOCTYPE html>
<html lang="id">
@vite('resources/css/app.css')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latih Hobi - Belajar & Kembangkan Skill</title>
    @vite('resources/css/app.css')
</head>
<body class="antialiased text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between p-4">
            <a href="/" class="text-2xl font-bold text-indigo-600">LatihHobi</a>
            <nav class="space-x-6 hidden md:flex">
                <a href="#program" class="hover:text-indigo-500">Program</a>
                <a href="#tentang" class="hover:text-indigo-500">Tentang Kami</a>
                <a href="#kontak" class="hover:text-indigo-500">Kontak</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-indigo-50 min-h-screen flex items-center justify-center text-center px-6 pt-20">
        <div>
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Belajar & Kembangkan Skill di LatihHobi</h1>
            <p class="text-lg md:text-xl text-gray-600 mb-6">Tempatnya anak muda berlatih hobi jadi skill profesional 🚀</p>
            <a href="#program" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Mulai Belajar</a>
        </div>
    </section>

    <!-- Program Section -->
    <section id="program" class="max-w-7xl mx-auto py-20 px-6">
        <h2 class="text-3xl font-bold text-center mb-12">Program Populer</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold mb-2">Kelas Musik</h3>
                <p class="text-gray-600">Belajar gitar, piano, dan vokal dengan mentor profesional.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold mb-2">Kelas Desain</h3>
                <p class="text-gray-600">Asah kreativitas dengan desain grafis, UI/UX, dan ilustrasi.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold mb-2">Kelas Bahasa</h3>
                <p class="text-gray-600">Tingkatkan skill komunikasi dengan bahasa asing.</p>
            </div>
        </div>
    </section>

    <!-- Tentang -->
    <section id="tentang" class="bg-gray-100 py-20 px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Tentang Kami</h2>
            <p class="text-gray-700 leading-relaxed">LatihHobi adalah platform belajar berbasis komunitas,
                memberi ruang untuk anak muda mengasah hobi dan menjadikannya skill profesional.
                Kami percaya bahwa hobi adalah investasi masa depan.</p>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="py-20 px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Kontak Kami</h2>
            <p>Email: <a href="mailto:info@latihhobi.id" class="text-indigo-600">info@latihhobi.id</a></p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6 text-center">
        <p>© 2025 Latih Hobi. All rights reserved.</p>
    </footer>

</body>
</html>
