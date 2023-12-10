<?php

namespace app\install;

class DbDataSeeder
{
    public static function getData() : array
    {
        return [
            'as_objs_tbl' =>
                self::getAddresses(),
            'user' =>
                self::getUsers(),
            'community' =>
                self::getCommunities(),
            'tag' =>
                self::getTags(),
            'post' =>
                self::getPosts(),
            'post_tags' =>
                self::getPostTags(),
            'like' =>
                self::getLikes(),
            'comment' =>
                self::getComments(),
            'comment_childs' =>
                self::getCommentChild(),
            'subscriber' =>
                self::getSubscribers(),
            'administrator' =>
                self::getAdmins(),
            'author' =>
            self::getAuthors()
        ];
    }
    private static function getAdmins() : array
    {
        return array(
            array(
                "user_id" => "703a953e-5fc6-49ed-ae68-74c587183b1b",
                "community_id" => "7b582894-fd4f-406d-a4b9-c54cbce7175e",
            ),
            array(
                "user_id" => "f6cd9f5c-300b-4066-ae12-c2a1c583a2d3",
                "community_id" => "1039028b-404f-4ff0-980a-6d6c5d8bb3ad",
            ),
            array(
                "user_id" => "f6cd9f5c-300b-4066-ae12-c2a1c583a2d3",
                "community_id" => "7b582894-fd4f-406d-a4b9-c54cbce7175e",
            ),
        );
    }

    private static function getAuthors() : array
    {
        return array(
            array(
                "id" => "0cdf0c92-0873-4921-8487-4da8e5d97d3e",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "posts" => 8,
                "likes" => 6,
            ),
            array(
                "id" => "0d06055f-7031-4835-bdba-c731067332b3",
                "user_id" => "703a953e-5fc6-49ed-ae68-74c587183b1b",
                "posts" => 0,
                "likes" => 0,
            ),
            array(
                "id" => "80713c3f-bd94-48a0-ae42-54980a0ff9ca",
                "user_id" => "5bd65b1b-2416-47d6-8c8c-f96cf356e678",
                "posts" => 1,
                "likes" => 0,
            ),
            array(
                "id" => "aa61881c-6635-4936-8f1a-bc7aeb8d449d",
                "user_id" => "f6cd9f5c-300b-4066-ae12-c2a1c583a2d3",
                "posts" => 1,
                "likes" => 4,
            ),
            array(
                "id" => "eb1e71fb-74b9-4d1a-bdab-5ea1c4e97c4c",
                "user_id" => "7f04501d-82af-42fc-8f12-4a1f3620e43c",
                "posts" => 1,
                "likes" => 3,
            ),
        );

    }

    private static function getComments() : array
    {
        return array(
            array(
                "id" => "1560c666-e870-4b8b-9944-be327d02913c",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "0cd937df-93a1-4546-9af8-f93af79d0b50",
                "parent_id" => "c0c3257d-6480-4c0d-8618-6c2830e67342",
                "content" => "мы...",
                "create_time" => "2023-12-06 08:10:00",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "229dbb8b-76c9-4730-b2b9-e7e3343b664e",
                "author_id" => "703a953e-5fc6-49ed-ae68-74c587183b1b",
                "author" => "notSonya",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "parent_id" => "8faf0a37-0d6f-4025-9f6a-4184a3b0f445",
                "content" => "4",
                "create_time" => "2023-12-02 22:03:23",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "2b7aa09a-10ef-4d6e-b0ee-ed05323de1d7",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "parent_id" => NULL,
                "content" => "string!!!!",
                "create_time" => "2023-12-04 14:57:08",
                "modification_time" => NULL,
                "delete_time" => "2023-12-04 23:09:07",
            ),
            array(
                "id" => "3f1f3a9d-3c5c-47c7-89a4-4212665809eb",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "parent_id" => NULL,
                "content" => "string!!!!",
                "create_time" => "2023-12-04 16:16:01",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "42be3137-a9cc-41d2-aa56-7b6b76c9869e",
                "author_id" => "7f04501d-82af-42fc-8f12-4a1f3620e43c",
                "author" => "eeeeeeeeex",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "parent_id" => "84b95112-4df1-4871-bf60-227b772ed886",
                "content" => "6",
                "create_time" => "2023-12-02 22:05:00",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "4300a7b6-8a7a-48e6-908d-65fbb30bfc12",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "parent_id" => "84b95112-4df1-4871-bf60-227b772ed886",
                "content" => "7",
                "create_time" => "2023-12-02 22:06:22",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "43d58bbf-43c2-4fb8-92e2-965e0581f7b5",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "0cd937df-93a1-4546-9af8-f93af79d0b50",
                "parent_id" => "59a99f9f-9dad-4653-bbb0-2f8c12295761",
                "content" => "мы",
                "create_time" => "2023-12-05 12:05:56",
                "modification_time" => "2023-12-06 08:10:52",
                "delete_time" => "2023-12-06 08:11:22",
            ),
            array(
                "id" => "49d9df08-0267-430a-abc6-b906f169b65b",
                "author_id" => "5bd65b1b-2416-47d6-8c8c-f96cf356e678",
                "author" => "eeeeeeeeex",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "parent_id" => "fdbc2eae-7112-4eb9-8e98-88ed76654c3c",
                "content" => "5",
                "create_time" => "2023-12-02 22:04:02",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "568f23ff-78d2-4674-84f9-2712e5273871",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "parent_id" => NULL,
                "content" => "a",
                "create_time" => "2023-12-05 11:31:08",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "59a99f9f-9dad-4653-bbb0-2f8c12295761",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "0cd937df-93a1-4546-9af8-f93af79d0b50",
                "parent_id" => "7a676d1f-f5c2-454b-9c9d-180885d49eab",
                "content" => "у меня шиза, прикиньте",
                "create_time" => "2023-12-05 12:05:40",
                "modification_time" => NULL,
                "delete_time" => "2023-12-05 12:25:58",
            ),
            array(
                "id" => "5b3cf04b-f7c4-44fc-8eb7-96bc49b5ce91",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "0cd937df-93a1-4546-9af8-f93af79d0b50",
                "parent_id" => "c0c3257d-6480-4c0d-8618-6c2830e67342",
                "content" => "мы...",
                "create_time" => "2023-12-06 09:53:42",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "66689fa7-82e6-4bb1-a3e9-ce3fedf44f38",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "parent_id" => NULL,
                "content" => "stringWithValidator",
                "create_time" => "2023-12-05 04:44:37",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "78b7365c-853b-4a05-b0df-756b11da5480",
                "author_id" => "f6cd9f5c-300b-4066-ae12-c2a1c583a2d3",
                "author" => "sonya",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "parent_id" => "42be3137-a9cc-41d2-aa56-7b6b76c9869e",
                "content" => "9",
                "create_time" => "2023-12-02 22:07:59",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "7a676d1f-f5c2-454b-9c9d-180885d49eab",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "0cd937df-93a1-4546-9af8-f93af79d0b50",
                "parent_id" => NULL,
                "content" => "я массон прикиньте",
                "create_time" => "2023-12-05 12:04:46",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "80cc6331-080a-4485-a1e5-d07c35b9e0f3",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "parent_id" => NULL,
                "content" => "string",
                "create_time" => "2023-12-03 14:41:48",
                "modification_time" => "2023-12-03 14:41:48",
                "delete_time" => "2023-12-03 14:41:48",
            ),
            array(
                "id" => "84b95112-4df1-4871-bf60-227b772ed886",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "parent_id" => "8faf0a37-0d6f-4025-9f6a-4184a3b0f445",
                "content" => "3",
                "create_time" => "2023-12-02 22:02:15",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "8faf0a37-0d6f-4025-9f6a-4184a3b0f445",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "parent_id" => NULL,
                "content" => "Ya Russkiy",
                "create_time" => "2023-12-02 16:48:10",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "af96a943-1b05-4846-8fab-de31c0775832",
                "author_id" => "5bd65b1b-2416-47d6-8c8c-f96cf356e678",
                "author" => "eeeeeeeeex",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "parent_id" => "42be3137-a9cc-41d2-aa56-7b6b76c9869e",
                "content" => "8",
                "create_time" => "2023-12-02 22:06:36",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "c0c3257d-6480-4c0d-8618-6c2830e67342",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "0cd937df-93a1-4546-9af8-f93af79d0b50",
                "parent_id" => "59a99f9f-9dad-4653-bbb0-2f8c12295761",
                "content" => "мы в курсе",
                "create_time" => "2023-12-05 12:10:20",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "dc8ae3b4-268b-4ce7-b144-af76822801f4",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "parent_id" => "80cc6331-080a-4485-a1e5-d07c35b9e0f3",
                "content" => "string!!!!",
                "create_time" => "2023-12-03 14:42:54",
                "modification_time" => "2023-12-03 14:42:54",
                "delete_time" => "2023-12-03 14:42:54",
            ),
            array(
                "id" => "ed839381-0d1d-4284-b355-657713ab082a",
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author" => "exexexe",
                "post_id" => "0cd937df-93a1-4546-9af8-f93af79d0b50",
                "parent_id" => "7a676d1f-f5c2-454b-9c9d-180885d49eab",
                "content" => "я тоже",
                "create_time" => "2023-12-05 12:05:23",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
            array(
                "id" => "fdbc2eae-7112-4eb9-8e98-88ed76654c3c",
                "author_id" => "7f04501d-82af-42fc-8f12-4a1f3620e43c",
                "author" => "eeeeeeeeex",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "parent_id" => "8faf0a37-0d6f-4025-9f6a-4184a3b0f445",
                "content" => "2",
                "create_time" => "2023-12-02 22:02:06",
                "modification_time" => NULL,
                "delete_time" => NULL,
            ),
        );

    }

    private static function getCommentChild() : array
    {
        return array(
            array(
                "comment_id" => "1560c666-e870-4b8b-9944-be327d02913c",
                "sub_comments" => 0,
            ),
            array(
                "comment_id" => "229dbb8b-76c9-4730-b2b9-e7e3343b664e",
                "sub_comments" => 0,
            ),
            array(
                "comment_id" => "2b7aa09a-10ef-4d6e-b0ee-ed05323de1d7",
                "sub_comments" => 0,
            ),
            array(
                "comment_id" => "3f1f3a9d-3c5c-47c7-89a4-4212665809eb",
                "sub_comments" => 0,
            ),
            array(
                "comment_id" => "42be3137-a9cc-41d2-aa56-7b6b76c9869e",
                "sub_comments" => 2,
            ),
            array(
                "comment_id" => "4300a7b6-8a7a-48e6-908d-65fbb30bfc12",
                "sub_comments" => 0,
            ),
            array(
                "comment_id" => "43d58bbf-43c2-4fb8-92e2-965e0581f7b5",
                "sub_comments" => 0,
            ),
            array(
                "comment_id" => "49d9df08-0267-430a-abc6-b906f169b65b",
                "sub_comments" => 0,
            ),
            array(
                "comment_id" => "568f23ff-78d2-4674-84f9-2712e5273871",
                "sub_comments" => 0,
            ),
            array(
                "comment_id" => "59a99f9f-9dad-4653-bbb0-2f8c12295761",
                "sub_comments" => 1,
            ),
            array(
                "comment_id" => "5b3cf04b-f7c4-44fc-8eb7-96bc49b5ce91",
                "sub_comments" => 0,
            ),
            array(
                "comment_id" => "66689fa7-82e6-4bb1-a3e9-ce3fedf44f38",
                "sub_comments" => 0,
            ),
            array(
                "comment_id" => "78b7365c-853b-4a05-b0df-756b11da5480",
                "sub_comments" => 0,
            ),
            array(
                "comment_id" => "7a676d1f-f5c2-454b-9c9d-180885d49eab",
                "sub_comments" => 1,
            ),
            array(
                "comment_id" => "80cc6331-080a-4485-a1e5-d07c35b9e0f3",
                "sub_comments" => 1,
            ),
            array(
                "comment_id" => "84b95112-4df1-4871-bf60-227b772ed886",
                "sub_comments" => 2,
            ),
            array(
                "comment_id" => "8faf0a37-0d6f-4025-9f6a-4184a3b0f445",
                "sub_comments" => 3,
            ),
            array(
                "comment_id" => "af96a943-1b05-4846-8fab-de31c0775832",
                "sub_comments" => 0,
            ),
            array(
                "comment_id" => "c0c3257d-6480-4c0d-8618-6c2830e67342",
                "sub_comments" => 2,
            ),
            array(
                "comment_id" => "dc8ae3b4-268b-4ce7-b144-af76822801f4",
                "sub_comments" => 0,
            ),
            array(
                "comment_id" => "ed839381-0d1d-4284-b355-657713ab082a",
                "sub_comments" => 0,
            ),
            array(
                "comment_id" => "fdbc2eae-7112-4eb9-8e98-88ed76654c3c",
                "sub_comments" => 1,
            ),
        );

    }

    private static function getCommunities() : array
    {
        return array(
            array(
                "id" => "1039028b-404f-4ff0-980a-6d6c5d8bb3ad",
                "create_time" => "2023-11-18 14:31:54",
                "name" => "Масонская ложа",
                "description" => "Место, помещение, где собираются масоны для проведения своих собраний, чаще называемых работами",
                "is_closed" => 1,
                "subscribers_count" => 1,
            ),
            array(
                "id" => "3e92ad31-8bd3-486a-be17-4ae180edcf29",
                "create_time" => "2023-11-28 01:34:51",
                "name" => "HITs!!!!!",
                "description" => "Лучший факультет, если вы не знали",
                "is_closed" => 0,
                "subscribers_count" => 0,
            ),
            array(
                "id" => "7b582894-fd4f-406d-a4b9-c54cbce7175e",
                "create_time" => "2023-11-18 21:33:02",
                "name" => "IT <3",
                "description" => "Информационные технологии связаны с изучением методов и средств сбора, обработки и передачи данных с целью получения информации нового качества о состоянии объекта, процесса или явления",
                "is_closed" => 0,
                "subscribers_count" => 1,
            ),
        );

    }

    private static function getLikes() : array
    {
        return array(
            array(
                "id" => "02467123-4d12-4e72-9c3f-52a06306f974",
                "create_time" => "2023-11-30 23:53:38",
                "delete_time" => NULL,
                "user_id" => "5bd65b1b-2416-47d6-8c8c-f96cf356e678",
                "post_id" => "fdf7ff72-fdce-437e-8874-cbb4d627fe23",
            ),
            array(
                "id" => "163282ce-172d-4df8-bda0-0b134fbb7ff5",
                "create_time" => "2023-12-06 08:56:31",
                "delete_time" => "2023-12-06 08:57:28",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "post_id" => "bdf3ebe6-ceb1-4e3c-96cd-b28be18be9dd",
            ),
            array(
                "id" => "27dbd386-7204-45d7-af89-e14cddcee50f",
                "create_time" => "2023-11-30 23:51:59",
                "delete_time" => NULL,
                "user_id" => "703a953e-5fc6-49ed-ae68-74c587183b1b",
                "post_id" => "7ca571d2-6cea-4970-b32b-400b0d0992fe",
            ),
            array(
                "id" => "2c3d0dfd-36df-44ee-a547-5e3c6f22889a",
                "create_time" => "2023-11-30 23:53:38",
                "delete_time" => NULL,
                "user_id" => "7f04501d-82af-42fc-8f12-4a1f3620e43c",
                "post_id" => "fdf7ff72-fdce-437e-8874-cbb4d627fe23",
            ),
            array(
                "id" => "2c903d3c-4d56-4b0a-bfa1-542157b8e777",
                "create_time" => "2023-11-29 22:41:22",
                "delete_time" => "2023-11-29 22:41:50",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "post_id" => "7ca571d2-6cea-4970-b32b-400b0d0992fe",
            ),
            array(
                "id" => "305e924d-88ab-4096-9ebc-5fede6bef99b",
                "create_time" => "2023-11-30 23:50:52",
                "delete_time" => NULL,
                "user_id" => "5bd65b1b-2416-47d6-8c8c-f96cf356e678",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
            ),
            array(
                "id" => "36b693c0-90e8-4202-87c1-af79eb4219e7",
                "create_time" => "2023-11-30 23:53:38",
                "delete_time" => NULL,
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "post_id" => "fdf7ff72-fdce-437e-8874-cbb4d627fe23",
            ),
            array(
                "id" => "6799970b-250b-4734-9a35-92ed818280f3",
                "create_time" => "2023-11-30 23:53:38",
                "delete_time" => NULL,
                "user_id" => "f6cd9f5c-300b-4066-ae12-c2a1c583a2d3",
                "post_id" => "fdf7ff72-fdce-437e-8874-cbb4d627fe23",
            ),
            array(
                "id" => "78e72241-34cc-4c3a-85b3-992b9c8dba46",
                "create_time" => "2023-12-05 11:57:54",
                "delete_time" => "2023-12-05 11:58:05",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "post_id" => "0cd937df-93a1-4546-9af8-f93af79d0b50",
            ),
            array(
                "id" => "a22cf3db-eb1b-48f1-a0f8-fc37df1bc7f5",
                "create_time" => "2023-12-04 14:35:38",
                "delete_time" => "2023-12-04 14:35:42",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "post_id" => "0cd937df-93a1-4546-9af8-f93af79d0b50",
            ),
            array(
                "id" => "ab7d02b5-cc0e-4d64-809e-53e23d7bbd37",
                "create_time" => "2023-12-02 16:38:59",
                "delete_time" => "2023-12-02 17:32:10",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "post_id" => "0cd937df-93a1-4546-9af8-f93af79d0b50",
            ),
            array(
                "id" => "b0fa63bb-2d81-4058-822a-581b58a11cfa",
                "create_time" => "2023-11-30 23:52:28",
                "delete_time" => NULL,
                "user_id" => "7f04501d-82af-42fc-8f12-4a1f3620e43c",
                "post_id" => "7ca571d2-6cea-4970-b32b-400b0d0992fe",
            ),
            array(
                "id" => "eb5fc375-0eb8-4473-ab8e-7e139cd105b0",
                "create_time" => "2023-12-02 17:33:29",
                "delete_time" => "2023-12-02 17:33:36",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "post_id" => "0cd937df-93a1-4546-9af8-f93af79d0b50",
            ),
            array(
                "id" => "ed5f183c-a773-4b60-a548-01b9ee9da347",
                "create_time" => "2023-12-04 14:35:16",
                "delete_time" => "2023-12-04 14:35:30",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "post_id" => "0cd937df-93a1-4546-9af8-f93af79d0b50",
            ),
            array(
                "id" => "f1967c0d-1056-4e4a-a8eb-74e35773788e",
                "create_time" => "2023-12-02 17:23:34",
                "delete_time" => "2023-12-02 17:32:53",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "post_id" => "0cd937df-93a1-4546-9af8-f93af79d0b50",
            ),
            array(
                "id" => "fa66a206-3cd8-444b-933b-e0b1fdb37c1c",
                "create_time" => "2023-11-30 23:50:52",
                "delete_time" => NULL,
                "user_id" => "7f04501d-82af-42fc-8f12-4a1f3620e43c",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
            ),
            array(
                "id" => "ffde110b-430b-4815-a44a-0db0145a2ff0",
                "create_time" => "2023-11-30 23:50:52",
                "delete_time" => NULL,
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
            ),
        );

    }

    private static function getPosts() : array
    {
        return array(
            array(
                "id" => "0cd937df-93a1-4546-9af8-f93af79d0b50",
                "create_time" => "2023-12-01 00:39:57",
                "title" => "asrtyuilkujthdgrsf",
                "description" => "sadftyjkujhgsfaddtfy",
                "reading_time" => 111,
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author_name" => "exexexe",
                "likes" => 4,
                "comments_count" => 5,
                "image" => NULL,
                "community_id" => "1039028b-404f-4ff0-980a-6d6c5d8bb3ad",
                "community_name" => "Масонская ложа",
                "address_id" => NULL,
            ),
            array(
                "id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "create_time" => "2023-11-30 21:01:31",
                "title" => "уаывпыпв",
                "description" => "Русский, если вы не заметили",
                "reading_time" => 22,
                "author_id" => "7f04501d-82af-42fc-8f12-4a1f3620e43c",
                "author_name" => "eeeeeeeeex",
                "likes" => 3,
                "comments_count" => 14,
                "image" => NULL,
                "community_id" => NULL,
                "community_name" => NULL,
                "address_id" => NULL,
            ),
            array(
                "id" => "7215d873-85a2-4853-bce4-855c267e0040",
                "create_time" => "2023-12-05 13:22:59",
                "title" => "тестим для юзера только с тегами еее",
                "description" => "sadasdasdasda",
                "reading_time" => 1000,
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author_name" => "exexexe",
                "likes" => 0,
                "comments_count" => 0,
                "image" => NULL,
                "community_id" => NULL,
                "community_name" => NULL,
                "address_id" => NULL,
            ),
            array(
                "id" => "7ca571d2-6cea-4970-b32b-400b0d0992fe",
                "create_time" => "2023-11-29 22:32:57",
                "title" => "dfaf",
                "description" => "asdfasga",
                "reading_time" => 1,
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author_name" => "exexexe",
                "likes" => 2,
                "comments_count" => 0,
                "image" => NULL,
                "community_id" => "7b582894-fd4f-406d-a4b9-c54cbce7175e",
                "community_name" => "IT <3",
                "address_id" => NULL,
            ),
            array(
                "id" => "a13a8205-4b7e-4f6f-824b-4b4aa439710c",
                "create_time" => "2023-11-30 20:57:23",
                "title" => "khdgfagfoua",
                "description" => "ashlahshfduasfdodagsfogaogfaogdf",
                "reading_time" => 10,
                "author_id" => "5bd65b1b-2416-47d6-8c8c-f96cf356e678",
                "author_name" => "eeeeeeeeex",
                "likes" => 0,
                "comments_count" => 0,
                "image" => NULL,
                "community_id" => "3e92ad31-8bd3-486a-be17-4ae180edcf29",
                "community_name" => "HITs!!!!!",
                "address_id" => NULL,
            ),
            array(
                "id" => "bdf3ebe6-ceb1-4e3c-96cd-b28be18be9dd",
                "create_time" => "2023-12-06 08:51:55",
                "title" => "тестим триггеры для постов ееее",
                "description" => "sadasdвапврорлборпиавasdasda",
                "reading_time" => 1000,
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author_name" => "exexexe",
                "likes" => 0,
                "comments_count" => 0,
                "image" => NULL,
                "community_id" => NULL,
                "community_name" => NULL,
                "address_id" => NULL,
            ),
            array(
                "id" => "cdbd69b6-0116-4414-b247-efb435f7600d",
                "create_time" => "2023-12-06 10:52:18",
                "title" => "раз раз валидатор раз раз",
                "description" => "sadasdвапврорлборпиавasdasda",
                "reading_time" => 1000,
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author_name" => "exexexe",
                "likes" => 0,
                "comments_count" => 0,
                "image" => NULL,
                "community_id" => NULL,
                "community_name" => NULL,
                "address_id" => NULL,
            ),
            array(
                "id" => "d5396022-067a-46c1-a7f0-c663af4d1b70",
                "create_time" => "2023-12-05 13:47:01",
                "title" => "тестим для юзера только с тегами а теперь еще и с коммьюнити ееееее",
                "description" => "sadasdasdasda",
                "reading_time" => 1000,
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author_name" => "exexexe",
                "likes" => 0,
                "comments_count" => 0,
                "image" => NULL,
                "community_id" => "1039028b-404f-4ff0-980a-6d6c5d8bb3ad",
                "community_name" => "Масонская ложа",
                "address_id" => NULL,
            ),
            array(
                "id" => "d6f132a6-bba6-4455-a379-f4198e2f5ba9",
                "create_time" => "2023-12-05 14:54:14",
                "title" => "тестим для юзера теперь еще и с полным валидатором ееееее",
                "description" => "sadasdasdasda",
                "reading_time" => 1000,
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author_name" => "exexexe",
                "likes" => 0,
                "comments_count" => 0,
                "image" => NULL,
                "community_id" => "1039028b-404f-4ff0-980a-6d6c5d8bb3ad",
                "community_name" => "Масонская ложа",
                "address_id" => NULL,
            ),
            array(
                "id" => "f988e153-4b16-4bbc-977b-c7ed2a8d2282",
                "create_time" => "2023-12-05 13:09:00",
                "title" => "тестим для юзера еее",
                "description" => "sadasdasdasda",
                "reading_time" => 1000,
                "author_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "author_name" => "exexexe",
                "likes" => 0,
                "comments_count" => 0,
                "image" => NULL,
                "community_id" => NULL,
                "community_name" => NULL,
                "address_id" => NULL,
            ),
            array(
                "id" => "fdf7ff72-fdce-437e-8874-cbb4d627fe23",
                "create_time" => "2023-11-30 20:58:15",
                "title" => "aaaa",
                "description" => "dfgyhujikolp;[rftyuioihgfdfghjklkjhgfghjkjhgffghjkjhgfghjhgfghjhgfghjhgfghj",
                "reading_time" => 100000,
                "author_id" => "f6cd9f5c-300b-4066-ae12-c2a1c583a2d3",
                "author_name" => "sonya",
                "likes" => 4,
                "comments_count" => 0,
                "image" => NULL,
                "community_id" => NULL,
                "community_name" => NULL,
                "address_id" => "eea14405-70df-413c-ac76-0db3dc15a6a3",
            ),
        );
    }

    private static function getPostTags() : array
    {
        return array(
            array(
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "tag_id" => "01b6d683-cf9b-49a7-9d53-65f7d4ccc270",
            ),
            array(
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "tag_id" => "6142aa72-05e1-41c2-a0bd-30425e121bbd",
            ),
            array(
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "tag_id" => "65004159-9814-415c-b83f-2974661e132e",
            ),
            array(
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "tag_id" => "eb1604e8-936c-416b-95e5-03e2ccbd8a2e",
            ),
            array(
                "post_id" => "13cb8f74-b448-44e4-a8a8-067830bc8931",
                "tag_id" => "f65c4732-9d93-4504-ac7d-babe92dc0879",
            ),
            array(
                "post_id" => "7215d873-85a2-4853-bce4-855c267e0040",
                "tag_id" => "65004159-9814-415c-b83f-2974661e132e",
            ),
            array(
                "post_id" => "7215d873-85a2-4853-bce4-855c267e0040",
                "tag_id" => "f65c4732-9d93-4504-ac7d-babe92dc0879",
            ),
            array(
                "post_id" => "7ca571d2-6cea-4970-b32b-400b0d0992fe",
                "tag_id" => "01b6d683-cf9b-49a7-9d53-65f7d4ccc270",
            ),
            array(
                "post_id" => "7ca571d2-6cea-4970-b32b-400b0d0992fe",
                "tag_id" => "6142aa72-05e1-41c2-a0bd-30425e121bbd",
            ),
            array(
                "post_id" => "bdf3ebe6-ceb1-4e3c-96cd-b28be18be9dd",
                "tag_id" => "65004159-9814-415c-b83f-2974661e132e",
            ),
            array(
                "post_id" => "bdf3ebe6-ceb1-4e3c-96cd-b28be18be9dd",
                "tag_id" => "f65c4732-9d93-4504-ac7d-babe92dc0879",
            ),
            array(
                "post_id" => "cdbd69b6-0116-4414-b247-efb435f7600d",
                "tag_id" => "65004159-9814-415c-b83f-2974661e132e",
            ),
            array(
                "post_id" => "cdbd69b6-0116-4414-b247-efb435f7600d",
                "tag_id" => "f65c4732-9d93-4504-ac7d-babe92dc0879",
            ),
            array(
                "post_id" => "d5396022-067a-46c1-a7f0-c663af4d1b70",
                "tag_id" => "65004159-9814-415c-b83f-2974661e132e",
            ),
            array(
                "post_id" => "d6f132a6-bba6-4455-a379-f4198e2f5ba9",
                "tag_id" => "65004159-9814-415c-b83f-2974661e132e",
            ),
            array(
                "post_id" => "fdf7ff72-fdce-437e-8874-cbb4d627fe23",
                "tag_id" => "01b6d683-cf9b-49a7-9d53-65f7d4ccc270",
            ),
        );

    }

    private static function getSubscribers() : array
    {
        return array(
            array(
                "id" => "093df778-c4bc-4968-b57a-fe0981df1c0d",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "community_id" => "1039028b-404f-4ff0-980a-6d6c5d8bb3ad",
                "subscribe_time" => "2023-12-05 12:02:48",
                "unsubscribe_time" => "2023-12-05 12:02:57",
            ),
            array(
                "id" => "373a740b-ef6f-4b67-993a-435bf688403c",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "community_id" => "1039028b-404f-4ff0-980a-6d6c5d8bb3ad",
                "subscribe_time" => "2023-12-06 08:09:08",
                "unsubscribe_time" => NULL,
            ),
            array(
                "id" => "7128ef20-dc70-4ec6-8d83-552b2a7e2492",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "community_id" => "1039028b-404f-4ff0-980a-6d6c5d8bb3ad",
                "subscribe_time" => "2023-12-05 12:03:02",
                "unsubscribe_time" => "2023-12-05 14:54:32",
            ),
            array(
                "id" => "790a03ac-58d5-49ed-9def-74859e82f454",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "community_id" => "7b582894-fd4f-406d-a4b9-c54cbce7175e",
                "subscribe_time" => "2023-11-30 17:41:04",
                "unsubscribe_time" => NULL,
            ),
            array(
                "id" => "cd830b69-a627-4cd7-974c-8f2d929eef25",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "community_id" => "7b582894-fd4f-406d-a4b9-c54cbce7175e",
                "subscribe_time" => "2023-11-29 07:42:40",
                "unsubscribe_time" => "2023-11-29 08:06:06",
            ),
            array(
                "id" => "f1655e12-d6f6-4cb5-ba8c-c2edab9beafb",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "community_id" => "7b582894-fd4f-406d-a4b9-c54cbce7175e",
                "subscribe_time" => "2023-11-29 08:36:04",
                "unsubscribe_time" => "2023-11-29 08:36:16",
            ),
            array(
                "id" => "f7d28a6b-8c7b-4c61-97b6-ce4383c8dc4c",
                "user_id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "community_id" => "7b582894-fd4f-406d-a4b9-c54cbce7175e",
                "subscribe_time" => "2023-11-29 15:34:26",
                "unsubscribe_time" => "2023-11-29 15:34:42",
            ),
        );

    }

    private static function getTags() : array
    {
        return array(
            array(
                "id" => "01b6d683-cf9b-49a7-9d53-65f7d4ccc270",
                "name" => "еда",
                "create_time" => "2023-11-28 01:04:14",
            ),
            array(
                "id" => "37fb882d-226e-4f0f-ae76-79afc8beac76",
                "name" => "косплей",
                "create_time" => "2023-11-28 01:02:52",
            ),
            array(
                "id" => "5387d954-972a-47bf-85b3-ff22e2f22be8",
                "name" => "приколы",
                "create_time" => "2023-11-27 15:12:48",
            ),
            array(
                "id" => "6142aa72-05e1-41c2-a0bd-30425e121bbd",
                "name" => "18+",
                "create_time" => "2023-11-27 15:12:25",
            ),
            array(
                "id" => "65004159-9814-415c-b83f-2974661e132e",
                "name" => "учеба",
                "create_time" => "2023-11-28 01:04:43",
            ),
            array(
                "id" => "eb1604e8-936c-416b-95e5-03e2ccbd8a2e",
                "name" => "аниме",
                "create_time" => "2023-11-28 01:03:27",
            ),
            array(
                "id" => "f65c4732-9d93-4504-ac7d-babe92dc0879",
                "name" => "it",
                "create_time" => "2023-11-27 15:12:07",
            ),
        );

    }

    private static function getUsers() : array
    {
        return array(
            array(
                "id" => "5bd65b1b-2416-47d6-8c8c-f96cf356e678",
                "email" => "exampleeeeee@mail.com",
                "password" => "6f8c09a01a4355235ba4cfcaa935a2daad494ec1",
                "create_time" => "2023-11-29 10:32:53",
                "full_name" => "eeeeeeeeex",
                "gender" => "Male",
                "birth_date" => "2004-08-27 05:42:13",
                "phone_number" => NULL,
            ),
            array(
                "id" => "703a953e-5fc6-49ed-ae68-74c587183b1b",
                "email" => "notsonya@mail.com",
                "password" => "eb46c18f2f5a88d85b6b25bd347b29697c2f5907",
                "create_time" => "2023-11-23 08:18:13",
                "full_name" => "notSonya",
                "gender" => "Male",
                "birth_date" => "2004-08-27 05:42:13",
                "phone_number" => NULL,
            ),
            array(
                "id" => "7f04501d-82af-42fc-8f12-4a1f3620e43c",
                "email" => "example@mail.com",
                "password" => "6f8c09a01a4355235ba4cfcaa935a2daad494ec1",
                "create_time" => "2023-11-24 13:42:50",
                "full_name" => "eeeeeeeeex",
                "gender" => "Male",
                "birth_date" => "2004-08-27 05:42:13",
                "phone_number" => NULL,
            ),
            array(
                "id" => "b368f928-7c0c-451a-b572-51b94f7296fa",
                "email" => "ex@mail.com",
                "password" => "6f8c09a01a4355235ba4cfcaa935a2daad494ec1",
                "create_time" => "2023-11-23 12:20:48",
                "full_name" => "exexexe",
                "gender" => "Male",
                "birth_date" => "2004-08-27 05:42:13",
                "phone_number" => NULL,
            ),
            array(
                "id" => "f6cd9f5c-300b-4066-ae12-c2a1c583a2d3",
                "email" => "sonya@mail.com",
                "password" => "e8a7472b0492f48a950035996ca13409d5056a12",
                "create_time" => "2023-11-23 08:17:51",
                "full_name" => "sonya",
                "gender" => "Female",
                "birth_date" => "2004-08-27 05:42:13",
                "phone_number" => NULL,
            ),
        );

    }

    private static function getAddresses() : \Generator
    {
        $fh = fopen(INC_APP_INSTALL . '/as_objs.csv', 'rb');
        $header = fgetcsv($fh, null, ';');
        while ($row = fgetcsv($fh, null, ';')) {
            yield array_combine($header, $row);
        }
        fclose($fh);
    }
}