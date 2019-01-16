<?php

namespace App\Plugins\Languages;


use App\Http\Controllers\Controller;
use App\Languages;
use App\Plugins\Languages\Functions\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{

    use Language;

    public function index() {
        return view('admin.elements.table', ['list' => Languages::all(), 'tableHeaders' => $this->getList(), "header" => "Languages", "showAddButton" => route('languages.add'), 'idField' => 'name', 'destroyName' => '']);
    }

    public function addLanguage() {
        return view('admin.elements.form', ['formElements' => $this->form(), 'content' => new Languages]);
    }

    public function editLanguage($id) {
        return view('admin.elements.form', ['formElements' => $this->form(), 'content' => Languages::findOrFail($id)]);
    }

    public function storeLanguage(Request $request, $id = false) {

        if(!$id) {
            $request->validate([
                'code' => 'unique:languages',
            ]);
        }

        $language = Languages::findOrNew($id);
        $language->fill(request(['code', 'name', 'is_default']));

        if($language->is_default) {
            Languages::where('id', "!=", $id)->update(['is_default' => false]);
        } else {
            $defaultLanguageCount = Languages::where('is_default', true)->where('id','!=',$id)->count();
            if($defaultLanguageCount==0) {
                $language->is_default=true;
            }
        }


        if($language->save()) {
            return redirect(route('languages'))->with('message', ['msg' => 'Language saved successfully']);
        }
        return redirect()->back();
    }

    public function destroyLanguage($id) {
        $language = Languages::findOrFail($id);
        $language->forceDelete();

        return ['status' => true, 'message' => "Language <strong>{$language->name}</strong> deleted"];
    }

    public function getEditName($id) {
        return Languages::find($id)->name??"";
    }
}