<?php

namespace App\Http\Controllers;


class LicenseController extends Controller
{
    static function courseLicense($course , $spotKey , $user)
    {
        try {
            $L = LicenseController::licenseNew($user, $spotKey, ['watermark']);
            $course->update([
                'spotPlayerId' => $L['_id'],
                'spotPlayerKey' => $L['key'],
                'spotPlayerUrl' => $L['url'],
            ]);
            return;

        } catch (Exception $e) {
            echo($e->getMessage());
        }
    }

    static function productLicense($product, $spotKey  , $user)
    {
        try {
            $L = LicenseController::licenseNew($user, $spotKey, ['watermark']);
            $product->update([
                'spotPlayerId' => $L['_id'],
                'spotPlayerKey' => $L['key'],
                'spotPlayerUrl' => $L['url'],
            ]);
            return;

        } catch (Exception $e) {
            echo($e->getMessage());
        }
    }

    ########################
    static function licenseNew($user, $courses, $watermarks, $device = null, $test = true)
    {
        return LicenseController::sendRequest('https://panel.spotplayer.ir/license/edit/', [
            'test' => $test,
            'name' => $user->name . ' ' . $user->last_name,
            'course' => $courses,
            'watermark' => ['texts' => array_map(function () use ($user) {
                return ['text' => $user->mobile];
            }, $watermarks)],
            'device' => $device
        ]);
    }

    ############################
    static function sendRequest($u, $o = null)
    {
        $API = 'YcgQ6DNNRIWh/ePlmt+AtFToyHM3hUY=';

        curl_setopt_array($c = curl_init(), [
            CURLOPT_URL => $u,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $o ? 'POST' : 'GET',
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTPHEADER => ['$api: ' . $API, '$level: -1', 'content-type: application/json'],
        ]);
        if ($o) curl_setopt($c, CURLOPT_POSTFIELDS, json_encode(LicenseController::filter($o)));
        $json = json_decode(curl_exec($c), true);
        curl_close($c);
        if (is_array($json) && ($ex = @$json['ex'])) throw new \Exception($ex['msg']);
        return $json;
    }


    /** @throws Exception */
    static function licenseEdit($id, $name = null, $confs = null, $limit = null, $device = null)
    {
        request('https://panel.spotplayer.ir/license/edit/' . $id, [
            'name' => $name,
            'data' => filter(['confs' => $confs, 'limit' => $limit]),
            'device' => $device
        ]);
    }

    /** @throws Exception */
    static function licenseList($course = null, $search = null)
    {
        return request('https://panel.spotplayer.ir/license/?$=json&' . http_build_query(array_filter([
                'course' => $course,
                'search' => $search,
            ], function ($v) {
                return !is_null($v);
            })));
    }


    #################################################################
    #################################################################
    #################################################################
    #################################################################
    #################################################################
    #################################################################

    static function filter($a)
    {
        return array_filter($a, function ($v) {
            return !is_null($v);
        });
    }

    static function image($p)
    {
        return $p ? ['data' => base64_encode(file_get_contents($p))] : null;
    }


    /** @throws Exception */
    static function courseNew($name, $link, $desc, $img = null, $limit = '0-')
    {
        return courseEdit('', $name, $link, $desc, $img, $limit);
    }

    /** @throws Exception */
    static function courseEdit($id, $name = null, $link = null, $desc = null, $img = null, $limit = null)
    {
        return request('https://panel.spotplayer.ir/course/edit/' . $id, [
            'name' => $name,
            'desc' => $desc,
            'img' => image($img),
            'link' => $link,
            'limit' => $limit
        ]);
    }


    /** @throws Exception */
    static function contentEdit($type, $id, $courses, $name, $desc, $open, $stat, $img = null, $rest = [])
    {
        return request('https://panel.spotplayer.ir/course/' . $type . '/edit/' . $id, array_merge($rest, [
            'course' => $courses,
            'stat' => $stat,
            'open' => $open,
            'name' => $name,
            'desc' => $desc,
            'img' => image($img)
        ]));
    }


    /** @throws Exception */
    static function segmentNew($courses, $name, $desc, $open = 0, $stat = 1)
    {
        return segmentEdit('', $courses, $name, $desc, $open, $stat);
    }

    /** @throws Exception */
    static function segmentEdit($id, $courses = null, $name = null, $desc = null, $open = null, $stat = null)
    {
        return contentEdit('segment', $id, $courses, $name, $desc, $open, $stat);
    }


    /** @throws Exception */
    static function videoNew($courses, $name, $desc, $mainUrl, $lowUrl = null, $img = null, $open = 0, $stat = 1)
    {
        return contentEdit('video', '', $courses, $name, $desc, $open, $stat, $img, [
            'f0' => ['url' => $mainUrl],
            'f1' => $lowUrl ? ['url' => $lowUrl] : null
        ]);
    }

    /** @throws Exception */
    static function videoEdit($id, $courses, $name, $desc, $img = null, $open = 0, $stat = 1, $lowUrl = null)
    {
        return contentEdit('video', $id, $courses, $name, $desc, $open, $stat, $img, [
            'f1' => $lowUrl ? ['url' => $lowUrl] : null
        ]);
    }


    static function lConfs($active = 1, $inactives = 0, $record = 0, $vm = 0, $process = 1)
    {

    }

    static function lDevice($all = null, $win = null, $mac = null, $lnx = null, $and = null, $ios = null, $web = null)
    {
        return filter(['p0' => $all, 'p1' => $win, 'p2' => $mac, 'p3' => $lnx, 'p4' => $and, 'p5' => $ios, 'p6' => $web]);
    }

    static function lPosition($tl = 1, $t = 1, $tr = 1, $ml = 1, $m = 1, $mr = 1, $bl = 1, $b = 1, $br = 1)
    {

    }

    static function lWatermarks($w1, $w2 = null, $w3 = null, $position = null, $move = null, $margin = null)
    {

    }

    static function lWatermark($text, $repeat = null, $font = null, $size = null, $color = null, $stSize = null, $stColor = null)
    {

    }


}
