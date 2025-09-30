@extends('layout.app')

@section('title', 'Contact LatihHobi')

@section('content')
<style>
    :root {
        --biru: #04a6d6;
        --oren: #f9a51a;
        --putih: #fff;
        --hitam: #1a2330;
    }
    .contact-main {
        max-width: 900px;
        margin: 0 auto;
        padding: 40px 16px 0 16px;
        background: var(--putih);
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(4,166,214,.08);
    }
    .contact-title {
        font-size: 32px;
        font-weight: 900;
        color: var(--biru);
        text-align: center;
        margin-bottom: 24px;
        letter-spacing: 2px;
        text-shadow: 0 2px 8px rgba(4,166,214,.08);
    }
    .contact-info-section {
        display: flex;
        flex-direction: column;
        gap: 32px;
        align-items: flex-start;
        margin-bottom: 40px;
    }
    .contact-col-info {
        width: 100%;
        background: var(--putih);
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(249,165,26,.08);
        padding: 32px 24px;
        border: 2px solid var(--biru);
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    .contact-info-desc {
        font-size: 17px;
        color: var(--hitam);
        margin-bottom: 12px;
        font-weight: 500;
        line-height: 1.6;
    }
    .contact-label {
        font-size: 16px;
        font-weight: 700;
        color: var(--oren);
        margin-bottom: 6px;
        margin-top: 12px;
        display: block;
        letter-spacing: 1px;
    }
    .wrapper-wa {
        width: 100%;
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .contact-btn {
        background: var(--biru);
        color: var(--putih);
        font-weight: 700;
        border: none;
        border-radius: 20px;
        padding: 10px 22px;
        font-size: 15px;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 8px;
        margin-top: 8px;
        transition: background .2s, box-shadow .2s;
        box-shadow: 0 2px 8px rgba(4,166,214,.12);
        border: 0px;
        text-align: center;
        width: 50%;
    }
    .contact-btn:hover {
        background: var(--oren);
        color: var(--putih);
        border-color: var(--biru);
        box-shadow: 0 4px 16px rgba(249,165,26,.18);
    }
    .contact-info-detail {
        font-size: 15px;
        color: var(--hitam);
        margin-bottom: 0;
        font-weight: 500;
        padding-left: 2px;
    }
    .contact-social-title {
        font-size: 18px;
        font-weight: 900;
        color: var(--hitam);
        text-align: center;
        margin: 10px 0 10px 0;
        letter-spacing: 2px;
        text-shadow: 0 2px 8px rgba(249,165,26,.08);
    }
    .contact-social-row {
        display: flex;
        gap: 20px;
        justify-content: center;
        align-items: center;
        margin-bottom: 30px;
    }
    .contact-social-link {
        color: var(--biru);
        font-size: 36px;
        transition: color .2s, transform .2s;
        text-decoration: none;
        background: none;
        border-radius: 0;
        padding: 0;
        box-shadow: none;
        border: none;
    }
    .wrapper-maps {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        flex-direction: column;
    }
    .googlemaps {
        display:flex; 
        justify-content: center;
        align-items: center;
        width: 100%;
        margin-bottom: 20px;
    }
    .contact-social-link:hover {
        color: var(--oren);
        background: none;
        transform: scale(1.12);
        border: none;
    }
    @media (max-width: 900px) {
        .contact-main { padding: 18px 4px 0 4px; }
        .contact-info-section { gap: 18px; }
        .contact-social-row { gap: 24px; }
    }
</style>

<!-- Font Awesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="contact-main">
    <div class="contact-title">CONTACT</div>
    <div class="contact-info-section">
        <div class="contact-col-info">
            <div class="contact-info-desc">
                Untuk menyampaikan informasi, pertanyaan dan keluhan dapat melalui beberapa media komunikasi berikut:
            </div>
            <div class="wrapper-maps">
                <span class="contact-label"><i class="fa-solid fa-map-location-dot"></i> ALAMAT</span>
                <div class="googlemaps">
                    <iframe 
                        src="https://www.google.com/maps?q=-6.9301894,107.6795654&hl=id&z=17&output=embed"
                        width="450" 
                        height="250" 
                        style="border: 1px; border-radius: 5px;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="contact-info-detail" style="text-align: center;">
                    Jl. Cisaranten Kulon No.16, Cisaranten Kulon, Kec. Arcamanik, Kota Bandung, Jawa Barat 40293
                </div>
            </div>   
            <div class="wrapper-wa">
                <span class="contact-label"><i class="fa-brands fa-whatsapp"></i> TELEPHONE</span>
                <a href="https://api.whatsapp.com/send/?phone=62895401070197&text&type=phone_number&app_absent=0" target="_blank" class="contact-btn">
                    <i class="fa-brands fa-whatsapp"></i> WhatsApp
                </a>
                <div class="contact-info-detail">
                    0895-4010-70197
                </div>
            </div>    
        </div>
    </div>
    <div class="contact-social-title">SOSIAL MEDIA KAMI</div>
    <div class="contact-social-row">
        <a href="https://www.instagram.com/latihhobi/" class="contact-social-link" target="_blank" title="Instagram">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="https://www.youtube.com/@Latihhobi" class="contact-social-link" target="_blank" title="YouTube">
            <i class="fab fa-youtube"></i>
        </a>
        <a href="https://www.tiktok.com/@latihhobi" class="contact-social-link" target="_blank" title="TikTok">
            <i class="fab fa-tiktok"></i>
        </a>
    </div>
</div>
@endsection