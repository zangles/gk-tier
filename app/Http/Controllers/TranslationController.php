<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Waavi\Translation\Models\Language;
use Waavi\Translation\Models\Translation;
use Waavi\Translation\Repositories\LanguageRepository;
use Waavi\Translation\Repositories\TranslationRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Application $app)
    {
        $locales = Language::withTrashed()->get();

        $transRepo = new TranslationRepository(new Translation(), $app);

        return view('trans.index', compact('transRepo', 'locales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locales = Language::withTrashed()->get();

        return view('trans.create', compact('locales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $locales = Language::withTrashed()->get();

        foreach ($locales as $locale) {
            $aux = new Translation();

            var_dump($locale->locale);
            $aux->create([
                'locale' => $locale->locale,
                'namespace' => $request->input('namespace'),
                'group' => $request->input('group'),
                'item' => $request->input('item'),
                'text' => $request->input('text_'.$locale->locale)
            ]);

        }

        return redirect()->route('trans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $app, $id)
    {
        $trans = Translation::findOrFail($id);
        $locales = Language::withTrashed()->get();
        $transRepo = new TranslationRepository(new Translation(), $app);

        return view('trans.edit', compact('trans', 'locales', 'transRepo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Application $app, Request $request, $id)
    {
        $trans = Translation::findOrFail($id);
        $locales = Language::withTrashed()->get();
        $transRepo = new TranslationRepository(new Translation(), $app);

        foreach ($locales as $locale) {
            $aux = $transRepo->findByCode($locale->locale, $trans->namespace, $trans->group, $trans->item);

            $transRepo->update($aux->id,$request->input('text_'.$locale->locale));
            $transRepo->flagAsReviewed($aux->id);
        }

        return redirect()->route('trans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $app, $id)
    {
        $trans = Translation::findOrFail($id);
        $transRepo = new TranslationRepository(new Translation(), $app);

        //namespace, group, and item
        $transRepo->deleteByCode($trans->group.'.'.$trans->item);

        return redirect()->route('trans.index');
    }

    public function getTrans(Application $app, $locale)
    {
        $transRepo = new TranslationRepository(new Translation(), $app);
        $aux = $transRepo->allByLocale($locale, 10);

        return response()->json($aux->toJson());
    }
}
