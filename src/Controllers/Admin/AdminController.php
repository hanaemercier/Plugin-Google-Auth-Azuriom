<?php

namespace Azuriom\Plugin\GoogleAuth\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Setting;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the Google Auth settings page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show()
    {
        return view('google-auth::admin.settings', [
            'client_id' => setting('google-auth.client_id', ''),
            'client_secret' => setting('google-auth.client_secret', ''),
            'max_per_ip' => setting('google-auth.max_per_ip', ''),
        ]);
    }

    public function save(Request $request)
    {
        $validated = $this->validate($request, [
            'client_id' => ['required', 'string', 'max:255'],
            'client_secret' => ['required', 'string', 'max:255'],
            'max_per_ip' => ['required', 'integer'],
        ]);

        Setting::updateSettings([
            'google-auth.client_id' => $validated['client_id'],
            'google-auth.client_secret' => $validated['client_secret'],
            'google-auth.max_per_ip' => $validated['max_per_ip'],
        ]);

        return redirect()->route('google-auth.admin.settings')->with('success', trans('admin.settings.updated'));
    }
}
