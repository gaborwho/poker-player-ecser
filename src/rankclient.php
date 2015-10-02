<?php

class RankResponse
{
    public $rank;
    public $value;
    public $second_value;
    public $kickers;
}

class RankClient
{
    /**
     * @param $data Card[]
     * @return RankResponse
     * @throws \Httpful\Exception\ConnectionErrorException
     */
    public function getRank($data)
    {
        $data = json_encode($data);
        $response = \Httpful\Request::post("http://rainman.leanpoker.org/rank", 'cards=' . $data)->send()->raw_body;
        $response = json_decode($response, true);

        $rank = new RankResponse();
        $rank->rank = $response['rank'];
        $rank->value = $response['value'];
        $rank->second_value = $response['second_value'];
        $rank->kickers = $response['kickers'];

        return $rank;
    }
}
