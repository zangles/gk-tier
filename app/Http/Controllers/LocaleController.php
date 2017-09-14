<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Waavi\Translation\Models\Language;
use Waavi\Translation\Models\Translation;
use Waavi\Translation\Repositories\LanguageRepository;

class LocaleController extends Controller
{
    public function index(Application $app)
    {
        $locales = Language::withTrashed()->get();
        $langRepo = new LanguageRepository(new Language(), $app);

        return view('locale.index', compact('locales', 'langRepo'));
    }

    public function create()
    {
        return view('locale.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'locale' => 'required|unique:translator_languages,locale',
            'name' => 'required|unique:translator_languages,name',
        ]);

        $locale = new Language();
        $locale->create(['locale' => $request->input('locale'), 'name' => $request->input('name')]);

        return redirect()->route('locale.index');
    }

    public function destroy($id)
    {
        $locale = Language::findOrFail($id);
        $trans = Translation::where('locale', $locale->locale)->delete();

        $locale->delete();

        return redirect()->route('locale.index');
    }

    public function edit($id)
    {
        $locale = Language::findOrFail($id);

        return view('locale.edit', compact('locale'));
    }

    public function restore($id)
    {
        $locale = Language::withTrashed()->findOrFail($id)->restore();

        return redirect()->route('locale.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:translator_languages,name',
        ]);

        $locale = Language::findOrFail($id);
        $locale->name = $request->input('name');
        $locale->save();


        return redirect()->route('locale.index');
    }
}
