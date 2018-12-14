<?php

namespace FarmGame\Service;

class StateService
{
    /**
     * @var string
     */
    protected $file = __DIR__.'/../../resources/rounds.json';

    /**
     * @var array
     */
    protected $animalMap = [
        'farmer' => 1,
        'cow'    => 2,
        'bunny'  => 4,
    ];

    /**
     * @return array|mixed
     */
    public function getState()
    {
        if (file_exists($this->file)) {
            return json_decode(file_get_contents($this->file));
        }

        return $this->animalMap;
    }
	
	/**
     * @return response string
     */
    public function getHistory()
    {
		$responseStr = '';
        if (file_exists($this->file)) {
            $res = json_decode(file_get_contents($this->file));
			$responseStr = "<br/>Round No : ".$res->turns;
			foreach($res->animals as $animals){
				$responseStr .= "  >> Mammal Name : ".$animals->mammalName ."  , Appetite : ".$animals->appetite;
			}
        }
        return $responseStr;
    }

    /**
     * @return bool
     */
    public function clearState()
    {
        if (file_exists($this->file)) {
            return unlink($this->file);
        }
        return true;
    }

    /**
     * @param $animals
     * @param $turns
     */
    public function saveState($animals, $turns)
    {
        $state = (object)[
            'fromFile' => true,
            'animals'  => $animals,
            'turns'    => $turns,
        ];
        file_put_contents(__DIR__.'/../../resources/rounds.json', json_encode($state));
    }
}
