# Concept

This document provides early insight into the ideas for this application.

The MediaCafe Application is a web application that manages a full TV Series, Movies and Music library. 

__Features__
- Scan existing files for import into library
- Retrieve metadata from thetvdb, themoviedb and theaudiodb
- Add new shows, movies and music to your library
- Tracks, Episodes or movies not on disk can be searched for on Torrent sites using [TorrentPotato](https://github.com/RuudBurger/CouchPotatoServer/wiki/Couchpotato-torrent-provider) API
- Auto download above mentioned media if found available through RSS feeds from [TorrentPotato](https://github.com/RuudBurger/CouchPotatoServer/wiki/Couchpotato-torrent-provider)
- Push the torrents to an compatible torrent program (e.a. transmission)
- Once the torrent completes move/copy/hardlink to the corresponding folder
- Rename folders to provided format
- Rename movies/episoded to provided format
- Push notification to several services to notify of on-grap/on-download/on-rename/on-upgrade
- Calendar functionality containing all releases of episodes and movies
- Auto add to library using last.fm

__Screens__
- Library overview
  - Series
  - Movies
  - Music
  - Add
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