<?php

namespace App\Services;

class ChatworkService
{
    public static function sendConfession($content)
    {
        try {
            $groups = env('CHATWORK_GROUPS', '');
            $groups = explode(',', $groups);
            if (count($groups)) {
                self::sendToChatwork($groups, $content);
            }
        } catch (\Exception $e) {
        }

        return true;
    }

    public static function sendNotifyToAdmin($content)
    {
        try {
            $admins = env('CHATWORK_ADMINS', '');
            $admins = explode(',', $admins);
            if (count($admins)) {
                self::sendToChatwork($admins, $content);
            }
        } catch (\Exception $e) {
        }

        return true;
    }

    public static function sendToChatwork($ids, $content)
    {
        $header = [];
        $header[] = 'X-ChatWorkToken: ' . $admins = env('CHATWORK_TOKEN', []);
        $params = ['body' => $content];

        $rooms = [];
        $rooms = is_array($ids) ? $ids : [$ids];
        $rooms = array_filter($rooms);
        foreach ($rooms as $room) {
            $url = 'https://api.chatwork.com/v2/rooms/' . $room . '/messages';
            if ($result = self::callCurl($url, $params, $header)) {
                $res = json_decode($result, true);
                if (isset($res['errors'])) {
                    \Log::error('ERROR: ' . implode($res['errors'], '|'));
                } else {
                }
            } else {
                \Log::error('Something error!' . $result);
            }
        }

        return true;
    }

    public static function callCurl($url, $params, $header = [])
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}