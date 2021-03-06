<?php

namespace App\Http\Controllers;

use App\Collection;
use App\CollectionsPage;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionPageController extends Controller
{

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * return the view to manage the page in the collection
     */
    public function add($id)
    {
        $collection = Collection::find($id);

        if (Auth::user()->can('update', $collection)) {

            $pagesInCollection = CollectionsPage::where('collection_id', $id)->get();

            $pagesAvailables = Page::where('user_id', Auth::user()->id)->get();

            $count = 0;

            foreach ($pagesAvailables as $page) {
                foreach ($pagesInCollection as $pageChecking) {
                    if ($pageChecking->page_id == $page->id) {
                        unset($pagesAvailables[$count]);
                    }
                }
                $count++;
            }

            return view('collection.addPages', [
                'collection' => $collection,
                'pagesAvailables' => $pagesAvailables,
                'pagesInCollection' => $pagesInCollection
            ]);
        }
        return redirect()->route('home')->with('danger', 'Vous n\'avez pas accès à cette collection');
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * store the added page in the collection in the database
     */
    public function store(Request $request, $id)
    {

        if ($request->input('checkbox') == null) {
            return redirect()->route('collection.addPages', $id)->with('danger', 'Veuillez séléctionner au minimum une page !');
        }
        $collection = Collection::find($id);
        if (Auth::user()->can('update', $collection)) {
            foreach ($request->input('checkbox') as $item) {
                $collectionPage = new CollectionsPage();

                $collectionPage->collection_id = $id;
                $collectionPage->page_id = $item;

                $collectionPage->save();
            }
            return redirect()->route('collection.addPages', $id)->with('success', 'Page(s) ajoutée(s) à la collection avec succès !');
        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas effectuer cette action');

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * delete the page to the collection
     */
    public function destroy(Request $request, $id)
    {
        if ($request->input('checkbox') == null) {
            return redirect()->route('collection.addPages', $id)->with('danger', 'Veuillez séléctionner au minimum une page !');
        }

        $collection = Collection::find($id);

        if (Auth::user()->can('delete', $collection)) {
            foreach ($request->input('checkbox') as $item) {
                CollectionsPage::where('page_id', $item)->delete();
            }
            return redirect()->route('collection.addPages', $id)->with('success', 'Page(s) suprimée(s) de la collection avec succès !');

        }
        return redirect()->route('home')->with('danger', 'Vous ne pouvez pas effectuer cette action');


    }
}
