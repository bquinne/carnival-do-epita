<?php

namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

/**
 * Class BquinnePlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 */
class BquinnePlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;



    public function getWinMove($move)
    {
        if ($move === 'scissors') {
            return parent::rockChoice();
        }
        if ($move === 'rock') {
            return parent::paperChoice();
        }
        if ($move === 'paper') {
            return parent::scissorsChoice();
        }
    }

    public function wtfStrategy()
    {

        if (($this->result->getNbRound() % 20) < 5) {
            return parent::scissorsChoice();
        } else {
            return $this->firstStrategy();
        }
    }

    public function wtfStrategy2()
    {

        if (($this->result->getNbRound() % 20) < 5) {
            return parent::scissorsChoice();
        } else {
            return $this->statStrategy();
        }
    }

    public function firstStrategy() {
        if ($this->result->getLastChoiceFor($this->opponentSide) == 'scissors') {
            return parent::rockChoice();
        }

        if ($this->result->getLastChoiceFor($this->opponentSide) == 'rock') {
            return parent::paperChoice();
        }

        if ($this->result->getLastChoiceFor($this->opponentSide) == 'paper') {
            return parent::scissorsChoice();
        }
    }

    public function statStrategy()
    {
        $stat = $this->result->getStatsFor($this->opponentSide);
        $total = $stat["scissors"] + $stat["rock"] + $stat["paper"];
        $scissorStat = $stat["scissors"] / $total;
        $rockStat = $stat["rock"] / $total;
        $paperStat = $stat["paper"] / $total;

        if ($scissorStat > $rockStat) {
            if ($scissorStat > $paperStat) {
                return $this->getWinMove('scissors');
            } else if ($paperStat > $rockStat) {
                return $this->getWinMove('paper');
            }
        } else {
            if ($rockStat > $paperStat) {
                return $this->getWinMove('rock');
            }
            else {
                return $this->getWinMove('paper');
            }
        }
        return $this->paperChoice();
    }

    public function getChoice()
    {

        return $this->wtfStrategy2();
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------
        
        return parent::paperChoice();
  }
};
