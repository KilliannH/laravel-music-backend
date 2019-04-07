// api routes :

[POST]

/songs
{"title", "path", "artistId"[], "albumId"[]}

/artists
{"name"}

/albums
{"title", "img_url"}

[PUT]

/songs/{id}
{"title", "path"}

    [DETACH]
    /songs/{id}/detach/artists
    {"artistId"[]}
    
    /songs/{id}/detach/albums
        {"albumId"[]}
    
    [ATACH]
        /songs/{id}/atach/artists
        {"artistId"[]}
        
        /songs/{id}/atach/albums
            {"albumId"[]}
            
/artists/{id}
{"name"}

/albums
{"title", "img_url"}

[DELETE]

/songs/{id}
/artists/{id}
/albums/{id}

* delete also remove relation(s)

[GET]

* get will always return associated fields

/songs
/songs/{id}

/artists
/artists/{id}

/albums
/albums/{id}

----------------------

TODO - getById, Attach, Detach.