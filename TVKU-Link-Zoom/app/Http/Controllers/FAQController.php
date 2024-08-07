<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function indexadmin()
    {
        $faqs = FAQ::all();
        return view('admin.manajemen-faq.manage-faq', compact('faqs'));
    }
    
    public function indexuser()
    {
        $faqs = FAQ::all();
        return view('user.faq', compact('faqs'));
    }    

    public function create()
    {
        return view('admin.manajemen-faq.create-faq');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        FAQ::create($request->only('question', 'answer'));

        return redirect()->route('admin.manage-faq')->with('success', 'FAQ berhasil ditambahkan');
    }

    public function edit($id)
    {
        $faq = FAQ::findOrFail($id);
        return view('admin.manajemen-faq.edit-faq', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq = FAQ::findOrFail($id);
        $faq->update($request->only('question', 'answer'));

        return redirect()->route('admin.manage-faq')->with('success', 'FAQ berhasil diperbarui');
    }

    public function destroy($id)
    {
        $faq = FAQ::findOrFail($id);
        $faq->delete();
    
        return redirect()->route('admin.manage-faq')->with('success', 'FAQ berhasil dihapus');
    }    
}
