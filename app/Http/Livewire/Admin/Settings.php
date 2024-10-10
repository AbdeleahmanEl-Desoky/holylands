<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;
    public $logo,$logoTemp,$site_name,$description,$address,$email,$mobile,$phone,$url_twitter ,$url_facebook ,$url_instagram ,$url_whatsapp ,$active ,$url_map;

    public function mount(){

        $this->logo = ($setting = Setting::where('name',"logo")->first()) ? $setting->value : '';
        $this->site_name = ($setting = Setting::where('name',"site_name")->first()) ? $setting->value : '';
        $this->description = ($setting = Setting::where('name',"description")->first()) ? $setting->value : '';
        $this->address = ($setting = Setting::where('name',"address")->first()) ? $setting->value : '';
        $this->email = ($setting = Setting::where('name',"email")->first()) ? $setting->value : '';
        $this->mobile = ($setting = Setting::where('name',"mobile")->first()) ? $setting->value : '';
        $this->phone = ($setting = Setting::where('name',"phone")->first()) ? $setting->value : '';
        $this->url_twitter = ($setting = Setting::where('name',"url_twitter")->first()) ? $setting->value : '';
        $this->url_facebook = ($setting = Setting::where('name',"url_facebook")->first()) ? $setting->value : '';
        $this->url_instagram = ($setting = Setting::where('name',"url_instagram")->first()) ? $setting->value : '';
        $this->url_whatsapp = ($setting = Setting::where('name',"url_whatsapp")->first()) ? $setting->value : '';
        $this->url_map = ($setting = Setting::where('name',"url_map")->first()) ? $setting->value : '';
        $this->active = ($setting = Setting::where('name',"active")->first()) ? $setting->value : '';

    }


    public function update()
    {
       $array =  $this->validate([
            'site_name' => 'required',
            'description' => '',
            'address' => '',
            'email' => '',
            'mobile' => '',
            'phone' => '',
            'url_twitter' => '',
            'url_facebook' => '',
            'url_instagram' => '',
            'url_whatsapp' => '',
            'url_map' => '',
            'active' => '',
          ]);

        foreach ($array as $key => $value) {
            if($key != "logo") {
                Setting::updateOrCreate(
                    ['name' => $key],
                    ['value' => $value]
                );
            }
        }


//        if($this->logoTemp){
//
//            $array =  $this->validate([
////                'logoTemp' => ['image','mimes:jpeg,png,jpg,gif','max:2048','dimensions:max_width=83,max_height=29']
//                'logoTemp' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048']
//            ]);
//
//            Setting::updateOrCreate(
//                ['name' => 'logo'],
//                ['value' => $this->logoTemp?$this->logoTemp->store('logos'):""]
//
//            );
//        }

        $this->emit('success', __("Updated successfully"));
//        return redirect()->route('admin.settings');

    }


    public function render()
    {
        return view('livewire.admin.settings')->layout('layouts.admins.app');
    }
}
