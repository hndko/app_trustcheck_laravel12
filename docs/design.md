# DESIGN.md

# TrustCheck AI Design System

Version : 1.0

---

# Design Philosophy

TrustCheck harus terasa seperti aplikasi enterprise profesional yang digunakan oleh perusahaan besar untuk melakukan due diligence dan verifikasi bisnis.

Tujuan utama adalah memberikan rasa:

- Trust
- Professional
- Fast
- Clean
- Objective
- Minimal

Jangan sampai tampak seperti:

- AI Chat
- ChatGPT Clone
- AI Assistant
- Crypto Dashboard
- Startup Landing Page berlebihan
- Glassmorphism UI
- Dashboard gaming
- Neon UI

Produk harus terasa seperti kombinasi antara:

- Stripe
- GitHub
- Notion
- Linear
- Cloudflare
- GOV Website Modern

---

# Design Principles

Semua keputusan desain harus mengikuti prinsip berikut.

1.

Information First

Informasi lebih penting daripada dekorasi.

2.

Content Driven

Setiap halaman harus fokus pada informasi.

3.

Professional

Tidak boleh terasa playful.

4.

Readable

Tipografi harus sangat mudah dibaca.

5.

Fast

UI ringan.

6.

Minimal

Hindari ornamen yang tidak diperlukan.

---

# Visual Style

Modern Enterprise

Flat Design

Soft Border

Soft Shadow

Neutral Color

High Readability

No Glassmorphism

No Neon

No Fancy Animation

No Floating Cards

No Heavy Gradient

No Blur Background

No Morphism

No Skeuomorphism

---

# Color Palette

Primary

Blue 600

#2563EB

Hover

#1D4ED8

Success

#16A34A

Warning

#D97706

Danger

#DC2626

Information

#0284C7

Background

#F8FAFC

Surface

#FFFFFF

Border

#E5E7EB

Divider

#F1F5F9

Primary Text

#0F172A

Secondary Text

#475569

Muted Text

#64748B

Disabled

#CBD5E1

---

# Border Radius

Small

8px

Medium

12px

Large

16px

Jangan gunakan radius lebih dari 20px.

---

# Shadow

Gunakan shadow sangat halus.

Contoh

shadow-sm

atau

shadow-md

Tidak boleh menggunakan shadow yang besar.

---

# Border

Semua card menggunakan border tipis.

1px solid

Border lebih penting daripada shadow.

---

# Layout

Maximum Width

1440px

Content Width

1280px

Padding Desktop

32px

Padding Tablet

24px

Padding Mobile

16px

---

# Grid

Desktop

12 Columns

Tablet

8 Columns

Mobile

1 Column

---

# Typography

Gunakan

Inter

atau

Geist

atau

Plus Jakarta Sans

Tidak menggunakan font dekoratif.

---

# Font Size

Hero

48

Page Title

36

Section Title

28

Card Title

20

Body

16

Small

14

Caption

12

---

# Font Weight

700

Heading

600

Subheading

500

Label

400

Body

---

# Icon

Gunakan

Lucide Icons

Ukuran

18

20

24

Tidak menggunakan icon berwarna-warni.

---

# Spacing

Gunakan kelipatan 4.

4

8

12

16

20

24

32

40

48

64

---

# Button

Primary

Blue

White Text

Rounded Medium

Height 44px

Secondary

White

Blue Border

Blue Text

Danger

Red

Ghost

Transparent

---

# Input

Rounded Medium

Border Gray

Height

48px

Focus

Blue Border

Blue Ring

Placeholder

Gray

Tidak menggunakan icon besar.

---

# Search Bar

Fokus utama homepage.

Lebar sekitar

700px

Center

Border

Radius

12

Shadow kecil.

---

# Cards

Semua informasi berada di dalam card.

Card harus:

White Background

Border

Padding 24

Radius 12

Shadow kecil

---

# Homepage

## Navbar

Logo

Search

About

Documentation

GitHub

Tidak ada tombol Login.

---

## Hero

Title besar

Cari reputasi perusahaan sebelum bekerja sama.

Subtitle

Ringkasan informasi perusahaan dari berbagai sumber publik dalam satu halaman.

Search Bar

Button Search

Di bawahnya:

Contoh pencarian.

---

## Popular Searches

Grid

2-4 kolom

Berisi contoh perusahaan.

---

## Features

3 Card

Company Information

Public Reputation

Website Analysis

Tidak menggunakan ilustrasi AI.

---

# Search Result Page

Layout

2 Column

Desktop

Sidebar

320px

Content

Flexible

---

# Sidebar

Berisi:

Trust Score

Quick Facts

Risk Level

Website

Industry

Founded

Location

Terlihat seperti panel informasi.

---

# Main Content

Urutan

1

Summary

2

Company Information

3

Public Reputation

4

News

5

Website Analysis

6

References

---

# Trust Score

Gunakan angka besar.

92

Di bawahnya

Low Risk

Progress Bar

Bukan gauge.

Tidak menggunakan speedometer.

---

# Summary

Card paling atas.

Maksimal

5 paragraf.

---

# Company Information

Gunakan table.

Label kiri

Value kanan.

---

# Reputation

Gunakan

Progress Bar

Badge

Tag

Tidak menggunakan Pie Chart.

---

# News

Vertical Timeline.

---

# References

Accordion.

Setiap source bisa di-expand.

---

# Badges

Verified

Blue

Positive

Green

Neutral

Gray

Warning

Orange

High Risk

Red

---

# Tables

Minimal.

Border bawah.

Tidak menggunakan zebra.

---

# Loading

Skeleton Loading.

Bukan spinner besar.

---

# Empty State

Icon

Text

Button Search Again

---

# Error State

Card Merah Tipis

Icon Alert

Penjelasan

---

# Mobile

Semua card menjadi full width.

Sidebar pindah ke atas.

Search selalu berada di atas.

---

# Animation

Gunakan sangat sedikit.

Hover

150ms

Transition

Ease

Tidak menggunakan:

Bounce

Zoom

Rotate

Pulse

Floating

Blur

---

# Accessibility

Contrast minimum WCAG AA

Focusable

Keyboard Friendly

ARIA Label

Responsive

---

# Dark Mode

Belum diperlukan.

Gunakan Light Mode saja.

---

# Illustration

Tidak menggunakan:

Robot

AI Brain

Circuit

Neural Network

Hexagon Background

Digital Wave

Gradient Blob

---

# Image Style

Jika diperlukan gunakan:

Office

Meeting

Building

Business

Company

Professional

Flat Illustration

---

# Component Consistency

Semua halaman WAJIB menggunakan:

- Border yang sama
- Radius yang sama
- Spacing yang sama
- Typography yang sama
- Button yang sama
- Badge yang sama
- Card yang sama

Tidak boleh membuat style baru di halaman tertentu.

---

# Overall Feeling

Ketika pengguna membuka website, kesan pertama harus:

"Website ini terlihat profesional, objektif, terpercaya, dan fokus pada informasi."

Bukan:

"Website AI"

Bukan:

"Landing Page Startup"

Bukan:

"Chatbot"

Tetapi seperti sebuah platform enterprise yang digunakan untuk melakukan verifikasi perusahaan secara profesional.
