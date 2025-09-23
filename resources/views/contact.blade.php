@extends('layout.app')

@section('title', 'Contact LatihHobi')

@section('content')
<style>
    .contact-main {
        max-width: 900px;
        margin: 0 auto;
        padding: 32px 16px 0 16px;
    }
    .contact-title {
        font-size: 28px;
        font-weight: 800;
        color: #04a6d6;
        text-align: center;
        margin-bottom: 18px;
        letter-spacing: 1px;
    }
    .contact-row {
        display: flex;
        flex-wrap: wrap;
        gap: 32px;
        margin-bottom: 32px;
        align-items: flex-start;
        justify-content: center;
    }
    .contact-col-info {
        flex: 1 1 320px;
        max-width: 400px;
        background: #f5f7fa;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0,0,0,.04);
        margin-bottom: 18px;
    }
    .contact-info-title {
        font-size: 18px;
        font-weight: 700;
        color: #0f3d5c;
        margin-bottom: 10px;
    }
    .contact-info-list {
        font-size: 15px;
        color: #222;
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .contact-info-list li {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .contact-col-form {
        flex: 2 1 400px;
        max-width: 500px;
        background: #fff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0,0,0,.04);
    }
    .contact-form-title {
        font-size: 18px;
        font-weight: 700;
        color: #04a6d6;
        margin-bottom: 10px;
    }
    .contact-form label {
        font-size: 15px;
        color: #0f3d5c;
        font-weight: 600;
        margin-bottom: 4px;
        display: block;
    }
    .contact-form input,
    .contact-form textarea {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #e8eef4;
        margin-bottom: 14px;
        font-size: 15px;
        background: #f5f7fa;
    }
    .contact-form textarea {
        min-height: 80px;
        resize: vertical;
    }
    .contact-form button {
        background: #04a6d6;
        color: #fff;
        font-weight: 700;
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        font-size: 16px;
        cursor: pointer;
        transition: background .2s;
    }
    .contact-form button:hover {
        background: #0f3d5c;
    }
    @media (max-width: 900px) {
        .contact-row { flex-direction: column; gap: 0; }
        .contact-col-info, .contact-col-form { max-width: 100%; }
    }
</style>

<div class="contact-main">
    <div class="contact-title">Contact LatihHobi</div>
    <div class="contact-row">
        <div class="contact-col-info">
            <div class="contact-info-title">Info Kontak</div>
            <ul class="contact-info-list">
                <li>📍 Alamat: Jl. Cisaranten Kulon No.16, Arcamanik, Bandung</li>
                <li>📞 Telp/WA: <a href="https://wa.me/6281222222222" target="_blank">0812-2222-2222</a></li>
                <li>✉️ Email: <a href="mailto:info@latihhobi.id">info@latihhobi.id</a></li>
                <li>🌐 Website: <a href="https://latihhobi.id" target="_blank">latihhobi.id</a></li>
                <li>📸 Instagram: <a href="https://instagram.com/latihhobi" target="_blank">@latihhobi</a></li>
            </ul>
        </div>
        <div class="contact-col-form">
            <div class="contact-form-title">Kirim Pesan</div>
            <form class="contact-form" method="post" action="#">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Pesan</label>
                <textarea id="message" name="message" required></textarea>
                <button type="submit">Kirim</button>
            </form>
        </div>
    </div>
</div>
@endsection