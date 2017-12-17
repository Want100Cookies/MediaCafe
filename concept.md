# Concept

This document provides early insight into the ideas for this application.

The MediaCafe Application is a web application that manages a full TV Series and Movies library. 

__Features__
- Scan existing files for import into library
- Retrieve metadata from thetvdb and themoviedb
- Add new series and movies to your library
- Episodes or movies not on disk can be searched for on Torrent sites using [TorrentPotato](https://github.com/RuudBurger/CouchPotatoServer/wiki/Couchpotato-torrent-provider) API
- Auto download above mentioned media if found available through RSS feeds from [TorrentPotato](https://github.com/RuudBurger/CouchPotatoServer/wiki/Couchpotato-torrent-provider)
- Push the torrents to an compatible torrent program (e.a. transmission)
- Once the torrent completes move/copy/hardlink to the corresponding folder
- Rename folders to provided format
- Rename movies/episoded to provided format
- Push notification to several services to notify of on-grap/on-download/on-rename/on-upgrade
- Calendar functionality containing all releases of episodes and movies

__Screens__
- Library overview
  - Series
  - Movies
  - Add (both series/movies but filter is possible)
- Calendar
- Activity (showing currently downloading and failed downloads)
- Wanted
- Settings
  - Media management
  - Quality
  - Indexers
  - Download client
  - Notifications
  - User management
  - UI
  - Updates
  - Tasks
  - Backups
  - Logs
  - System

__Models__
- Movie
  - title (string) 
  - titleSlug (string) 
  - description (string) 
  - year (int)
  - genre (string)
  - quality_id (int)
  - moviedbid (string)
  - imdbid (string)
- Serie
  - title (string) 
  - titleSlug (string) 
  - description (string) 
  - year (int)
  - path (string) 
  - genre (string)
  - quality_id (int)
  - episodeCount (int)
  - sizeOnDisk (int)
  - network (e.a. Marvels) (string) 
  - tvdbid (string) 
  - tvmazeid (string) 
  - imdbid (string) 
- Season
  - serie_id (int)
  - quality_id (int)
  - title (string) 
  - number (int)
  - monitored (bool)
  - sizeOnDisk (int)
- Episode
  - season_id (int)
  - title (string)
  - number (int)
  - airDate (date)
  - monitored (bool)
- File
  - polymorphic relation
    - fileable_id (int)
    - fileable_type (string)
  - quality_id (int)
  - relativePath (string)
  - path (string)
  - sizeOnDisk (int)
  - dateAdded (date)
- Torrent
  - polymorphic relation
    - torrentable_id (int)
    - torrentable_type (string) (can be movie/episode/season)
  - quality_id (int)
  - indexer_id (int)
  - title (string)
  - publishDate (date)
  - size (int)
  - approved (bool)
  - commentUrl (string)
  - downloadUrl (string)
  - infoUrl (string)
  - magnetUrl (string)
  - infoHash (string)
  - seeders (int)
  - leechers (int)
- Indexer
  - name (string)
  - implementation (string)
  - settings (json)
- Quality
  - weight
