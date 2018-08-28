<?php
namespace App\Repositories\Setting;

use App\Models\Setting;
use Auth;
/**
 * Class SettingRepository
 * @package App\Repositories\Setting
 */
class SettingRepository implements SettingRepositoryContract
{
    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return Setting::where('company_id', Auth::user()->company_id)->firstOrFail()->company;
    }

    /**
     * @param $requestData
     */
    public function updateOverall($requestData)
    {
        $setting = Setting::findOrFail(1);

        $setting->fill($requestData->all())->save();
    }

    /**
     * @return mixed
     */
    public function getSetting()
    {
        return Setting::where('company_id', Auth::user()->company_id)->firstOrFail();
    }

    public function updateCustom($requestData) {
        $setting = Setting::where('company_id', Auth::user()->company_id)->firstOrFail();

        if($file = $requestData->hasFile('logo_img')) {
            $file = $requestData->file('logo_img');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/logo/';
            $file->move($destinationPath,$fileName);
            $setting->logo_img = $fileName;
        }
        $setting->logo_color = $requestData->get('logo_color');
        if ($requestData->has('email_notification') && $requestData->has('browser_notification')) {
            $setting->notification_allowed = 1;
        } else if ($requestData->has('email_notification')) {
            $setting->notification_allowed = 2;
        } else if ($requestData->has('browser_notification')) {
            $setting->notification_allowed = 3;
        } else {
            $setting->notification_allowed = 0;
        }

        $setting->save();

        return $setting->logo_img;
    }
}
