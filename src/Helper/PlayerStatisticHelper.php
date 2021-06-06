<?php


namespace App\Helper;


class PlayerStatisticHelper
{

	private $totalGamesPlayed;

	public function __construct(array $totalGamesPlayed)
	{
		$this->totalGamesPlayed = $totalGamesPlayed;
	}

	public function getPlayerStatistic(): array
	{
		$percentWinAsMafia = $this->getWinPercentWithRole("Мафия");
		$percentWinAsDon = $this->getWinPercentWithRole("Дон");
		$percentWinAsSherif = $this->getWinPercentWithRole("Шериф");
		$percentWinAsCivilian = $this->getWinPercentWithRole("Мирный житель");
		$totalGamesPlayed = $this->getAmountOfPlayedGames();

		return [
			"total_games_played" => $totalGamesPlayed ,
			"mafia" => $percentWinAsMafia,
			"civilian" => $percentWinAsCivilian,
			"sherif" => $percentWinAsSherif,
			"don" => $percentWinAsDon
		];
	}

	private function getWinPercentWithRole(string $role): int
	{
		$listOfPlayedRoles = array_column($this->totalGamesPlayed, 'role');
		$amountOfPlayedGames = $this->getAmountOfPlayedGames();
		return array_count_values($listOfPlayedRoles)[$role] / $amountOfPlayedGames * 100;
	}

	private function getAmountOfPlayedGames(): int
	{
		return count($this->totalGamesPlayed);
	}


}