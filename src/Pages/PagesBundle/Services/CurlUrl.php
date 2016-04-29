<?php


namespace Pages\PagesBundle\Services;


class CurlUrl
{
    /**
     * Varifie si une domaine existe (activation de curl)
     * @param $site
     * @return bool
     */
    public function check($site)
    {
        $site = curl_init($site);
        curl_setopt($site, CURLOPT_FAILONERROR, true);
        curl_setopt($site, CURLOPT_NOBODY, true);

        curl_exec($site) === false ? $curl = false : $curl = true;

        curl_close($site);

        return $curl;
    }

    public function findUrl($value)
    {
        $violation = false;
        $urls = preg_match_all('/<a href="(.*)">/', $value, $url);

        foreach(array_unique($url[1]) as $site)
        {
            if ($this->check($site) === false) {
                $violation = true;
            }
        }

        return $violation;
    }

}