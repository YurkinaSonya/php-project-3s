<?php
require_once INC_APP_ENUM . '/Gender.php';

require_once INC_APP_MODEL . '/Community.php';
require_once INC_APP_MODEL . '/User.php';
require_once INC_APP_MODEL . '/Token.php';

require_once INC_APP_DTO . '/CommunityDto.php';
require_once INC_APP_DTO . '/LoginCredentialsDto.php';
require_once INC_APP_DTO . '/UserDto.php';
require_once INC_APP_DTO . '/UserEditDto.php';
require_once INC_APP_DTO . '/UserRegisterDto.php';

require_once INC_APP_REPOSITORY . '/CommunityRepository.php';
require_once INC_APP_REPOSITORY . '/TokenRepository.php';
require_once INC_APP_REPOSITORY . '/UserRepository.php';

require_once INC_APP_CONTROLLER . '/IndexController.php';
require_once INC_APP_CONTROLLER . '/CommunityController.php';
require_once INC_APP_CONTROLLER . '/AuthorizationController.php';

require_once INC_APP_SERVICE . '/TokenService.php';
require_once INC_APP_SERVICE . '/EncryptService.php';

require_once INC_APP_MIDDLEWARE . '/AbstractUserValidator.php';
require_once INC_APP_MIDDLEWARE . '/LoginValidator.php';
require_once INC_APP_MIDDLEWARE . '/RegisterValidator.php';
require_once INC_APP_MIDDLEWARE . '/TokenMiddleware.php';







