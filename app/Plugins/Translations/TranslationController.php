<?php

namespace App\Plugins\Translations;


use App\Functions\General;
use App\Plugins\Translations\Functions\Translations;
use App\Plugins\Translations\Model\Translation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class TranslationController
{
    use Translations;
    use General;

    public function index(LengthAwarePaginator $translation = null)
    {
        $translation = $translation ?? Translation::with('metaData')->paginate(20);

        return view('Translations::list',
            [
                'tableHeaders' => $this->getList(),
                'header'       => 'Translations',
                'list'         => $translation,
                'idField'      => 'name',
                'destroyName'  => 'Translation',
                'modalId'      => ["Translations" => str_random(20)],
            ]);
    }

    public function search($search)
    {

        $search = "%$search%";

        /** @var Translation $translations */
        $translations = Translation::with('metaData');

        $translations->whereHas('metaData', function (Builder $q) use ($search) {
            $q->where('meta_value', 'like', $search);
        })->orWhere('key', 'like', $search);

        return $this->index($translations->paginate(10));
    }

    public function edit($id)
    {
        return [
            'translation' => Translation::with('metaData')->where('id', $id)->first(),
            'noMessage'   => true,
        ];
    }

    public function store(Request $request, $id)
    {

        try {
            DB::beginTransaction();
            /** @var Translation $translation */
            $translation = Translation::findOrFail($id);

            $metas = [
                'translation',
            ];

            $this->handleMetas($translation, $metas);
            $translation->forgetMeta();
            $translationData = request('translation');
            $translationData = $translationData[language()];
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();

            return ['status' => false];
        }

        return ["status" => true, "lineID" => $translation->id, "edited" => $translationData, "message" => 'Translation Saved'];
    }

    public function collect()
    {
        $lookingIn = [
            app_path(),
            resource_path('lang'),
            resource_path('views'),
        ];

        $lookingFor = [
            "/__\('translations.([^']*)'([^)]*)/",
            "/trans\('translations.([^']*)'([^)]*)/",
            '/__\("translations.([^"]*)"([^)]*)/',
            '/trans\("translations.([^"]*)"([^)]*)/',
        ];

        $translations = [];
        foreach ($lookingFor as $findText) {
            foreach ($lookingIn as $dir) {
                $translations = array_merge($translations, $this->iterate($dir, $findText));
            }
        }
        foreach ($translations as $translation) {
            if ($translation) {
                Translation::firstOrCreate(['key' => $translation['key']], ['params' => $translation['params']]);
            }
        }

        return redirect()->route('translations');
    }
}