<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function showFaq()
    {
        $faqs = Faq::orderBy('sort_order', 'asc')->get();

        return view('admin.faq.admin_faq_show', compact('faqs'));
    }

    public function showFaqContactSection(){
        $faqs = Faq::get();

        $setting = Setting::first();

        return view('faq', compact('faqs', 'setting'));
    }

    public function FaqCreate()
    {
        return view('admin.faq.admin_faq_create');
    }

    public function FaqStore(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'sort_order' => 'nullable|integer',
        ]);

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.faq')
            ->with('success', 'FAQ Added Successfully');
    }


    public function FaqEdit($id)
    {
        $faq = Faq::findOrFail($id);

        return view('admin.faq.admin_faq_edit', compact('faq'));
    }

    public function FaqUpdate(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'sort_order' => 'nullable|integer',
        ]);

        $faq = Faq::findOrFail($id);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order,
        ]);

        return redirect()->route('admin.faq')
            ->with('success', 'FAQ Updated Successfully');
    }

    public function FaqDestroy($id)
    {
        Faq::findOrFail($id)->delete();

        return redirect()->back()
            ->with('success', 'FAQ Deleted Successfully');
    }
}
