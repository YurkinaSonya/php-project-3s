<?php

namespace app\enum;

enum ObjectLevel : string
{
    case Region = 'Субъект РФ';
    case AdministrativeArea = 'Административный район';
    case MunicipalArea = 'Муниципальный район';
    case RuralUrbanSettlement = 'Поселок городского типа';
    case City = 'Город';
    case Locality = 'Населенный пункт';
    case ElementOfPlanningStructure = 'Элемент планировочной структуры';
    case ElementOfRoadNetwork = 'Элемент улично-дорожной сети';
    case Land = 'Участок';
    case Building = 'Здание (сооружение)';
    case Room = 'Квартира';
    case RoomInRooms = 'Комната в квартире';
    case AutonomousRegionLevel = 'Автономный уровень региона';
    case IntracityLevel = 'Внутригородской уровень';
    case AdditionalTerritoriesLevel = 'Дополнительная теретория';
    case LevelOfObjectsInAdditionalTerritories = 'Объект в дополнительной аудитории';
    case CarPlace = 'Автомобильная парковка';

}