<?php
require_once INC_APP_ENUM . '/Gender.php';
require_once INC_APP_ENUM . '/ObjectLevel.php';

require_once INC_APP_MODEL . '/Address.php';
require_once INC_APP_MODEL . '/Community.php';
require_once INC_APP_MODEL . '/User.php';
require_once INC_APP_MODEL . '/Token.php';
require_once INC_APP_MODEL . '/Subscribe.php';
require_once INC_APP_MODEL . '/Tag.php';
require_once INC_APP_MODEL . '/Post.php';
require_once INC_APP_MODEL . '/Comment.php';
require_once INC_APP_MODEL . '/Like.php';

require_once INC_APP_DTO . '/SearchAddressDto.php';
require_once INC_APP_DTO . '/CommunityDto.php';
require_once INC_APP_DTO . '/CommunityUserDto.php';
require_once INC_APP_DTO . '/CommunityFullDto.php';
require_once INC_APP_DTO . '/LoginCredentialsDto.php';
require_once INC_APP_DTO . '/UserDto.php';
require_once INC_APP_DTO . '/ResponseDto.php';
require_once INC_APP_DTO . '/UserEditDto.php';
require_once INC_APP_DTO . '/UserRegisterDto.php';
require_once INC_APP_DTO . '/TagDto.php';
require_once INC_APP_DTO . '/PostDto.php';
require_once INC_APP_DTO . '/PostFullDto.php';
require_once INC_APP_DTO . '/CommentDto.php';
require_once INC_APP_DTO . '/PageInfoDto.php';

require_once INC_APP_REPOSITORY . '/AddressRepository.php';
require_once INC_APP_REPOSITORY . '/CommunityRepository.php';
require_once INC_APP_REPOSITORY . '/AdministratorRepository.php';
require_once INC_APP_REPOSITORY . '/TokenRepository.php';
require_once INC_APP_REPOSITORY . '/UserRepository.php';
require_once INC_APP_REPOSITORY . '/SubscribeRepository.php';
require_once INC_APP_REPOSITORY . '/TagRepository.php';
require_once INC_APP_REPOSITORY . '/PostRepository.php';
require_once INC_APP_REPOSITORY . '/LikeRepository.php';
require_once INC_APP_REPOSITORY . '/CommentRepository.php';

require_once INC_APP_CONTROLLER . '/IndexController.php';
require_once INC_APP_CONTROLLER . '/AddressController.php';
require_once INC_APP_CONTROLLER . '/CommunityController.php';
require_once INC_APP_CONTROLLER . '/AuthorizationController.php';
require_once INC_APP_CONTROLLER . '/PostController.php';

require_once INC_APP_SERVICE . '/TokenService.php';
require_once INC_APP_SERVICE . '/EncryptService.php';

require_once INC_APP_MIDDLEWARE . '/AddressSearchValidator.php';
require_once INC_APP_MIDDLEWARE . '/AddressChainValidator.php';
require_once INC_APP_MIDDLEWARE . '/AbstractUserValidator.php';
require_once INC_APP_MIDDLEWARE . '/LoginValidator.php';
require_once INC_APP_MIDDLEWARE . '/RegisterValidator.php';
require_once INC_APP_MIDDLEWARE . '/SubscribeValidator.php';
require_once INC_APP_MIDDLEWARE . '/UnsubscribeValidator.php';
require_once INC_APP_MIDDLEWARE . '/ProfileValidator.php';
require_once INC_APP_MIDDLEWARE . '/CommunityValidator.php';
require_once INC_APP_MIDDLEWARE . '/PostFilterValidator.php';
require_once INC_APP_MIDDLEWARE . '/GetPostValidator.php';
require_once INC_APP_MIDDLEWARE . '/CommentTreeValidator.php';
require_once INC_APP_MIDDLEWARE . '/AddLikeValidator.php';
require_once INC_APP_MIDDLEWARE . '/RemoveLikeValidator.php';
require_once INC_APP_MIDDLEWARE . '/TokenMiddleware.php';







