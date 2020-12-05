<?php
return [
    'resources' => [
//        Upload
        'upload' => [
            'image' => 'mimetypes:jpeg, jpg, png',
            'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime',
        ],

// Post
        'post' => [
            'allowedSorts' => [
              'id'
            ],
            'allowedFilters' => [
                'title',
                'content'
            ],
            'allowedIncludes' => [
                'user',
                'comments'
            ],
            'allowedFields' => [
                'id',
                'title',
                'content',
                'created_at',
                'updated_at'
            ],
            'paginate' => 10,
            'validationRules'=> [
                'create' => [
                    'title' => 'required|string|max:255',
                    'content' => 'required|string|max:255',
                    'user_id' => 'integer|max:22|exists:users,id',
                ],
                'update' => [
                    'title' => 'required|string|max:255',
                    'content' => 'required|string|max:255',
                    'user_id' => 'integer|max:22|exists:users,id',
                ]
            ]
        ],


        // User
        'user' => [
            'allowedSorts' => [
                'id'
            ],
            'allowedFilters' => [
                'name',
                'email'
            ],
            'allowedIncludes' => [
                'post',
            ],
            'allowedFields' => [
                'id',
                'name',
                'email',
                'created_at',
                'updated_at'
            ],
            'paginate' => 10,
            'validationRules'=> [
                'create' => [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|max:255|unique:users,email',
                    'password' => 'required|string|max:22',
                ],
                'update' => [
                    'name' => 'required|string|max:255',
                    'password' => 'required|string|max:22',
                ]
            ]
        ],




    ]
];
