<?php


namespace App\Helper;


class PlayerStatisticHelper
{

	private $totalGamesPlayed;
	public function __construct(array $totalGamesPlayed)
	{
		$this->totalGamesPlayed = $totalGamesPlayed;
	}

	public function getPercentStatisticForAllRoles() : array
	{
		$percentWinAsMafia = $this->getWinPercentWithRole("Мафия") ;
		$percentWinAsDon = $this->getWinPercentWithRole("Дон");
		$percentWinAsSherif = $this->getWinPercentWithRole("Шериф");
		$percentWinAsCivilian = $this->getWinPercentWithRole("Мирный житель");

		return ["mafia" => $percentWinAsMafia, "civilian" => $percentWinAsCivilian, "sherif" => $percentWinAsSherif, "don" => $percentWinAsDon];
	}

	private function getWinPercentWithRole( string $role): int
	{
		$totalPlayedRoles = array_column($this->totalGamesPlayed, 'role');
		$amountOfTotalPlayedGames = count($totalPlayedRoles);
		return array_count_values($totalPlayedRoles)[$role] / $amountOfTotalPlayedGames * 100;
	}


}