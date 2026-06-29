<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Tampilkan daftar FAQ untuk dikelola.
     */
    public function index()
    {
        $faqs = Faq::orderBy('order')->get();

        $data = [
            'title' => 'Kelola FAQ Publik — TrustCheck Kelola',
            'faqs' => $faqs,
        ];

        return view('backend.faq.index', $data);
    }

    /**
     * Tampilkan form tambah FAQ baru.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah FAQ Baru — TrustCheck Kelola',
        ];

        return view('backend.faq.create', $data);
    }

    /**
     * Simpan data FAQ baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'order' => ['required', 'integer'],
            'is_active' => ['boolean'],
        ], [
            'question.required' => 'Pertanyaan wajib diisi.',
            'answer.required' => 'Jawaban penjelasan wajib diisi.',
            'order.required' => 'Urutan tampilan wajib diisi.',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Faq::create($validated);

        return redirect()->route('portal.faq.index')->with('success', 'FAQ baru berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit FAQ.
     */
    public function edit(string $id)
    {
        $faq = Faq::findOrFail($id);

        $data = [
            'title' => 'Edit FAQ — TrustCheck Kelola',
            'faq' => $faq,
        ];

        return view('backend.faq.edit', $data);
    }

    /**
     * Perbarui data FAQ di database.
     */
    public function update(Request $request, string $id)
    {
        $faq = Faq::findOrFail($id);

        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'order' => ['required', 'integer'],
            'is_active' => ['boolean'],
        ], [
            'question.required' => 'Pertanyaan wajib diisi.',
            'answer.required' => 'Jawaban penjelasan wajib diisi.',
            'order.required' => 'Urutan tampilan wajib diisi.',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $faq->update($validated);

        return redirect()->route('portal.faq.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    /**
     * Hapus FAQ dari database.
     */
    public function destroy(string $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('portal.faq.index')->with('success', 'FAQ berhasil dihapus.');
    }
}
