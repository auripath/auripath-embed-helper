# WordPress.org Release Notes

This plugin is developed in GitHub, but WordPress.org plugin releases are published through Subversion (SVN).

Public plugin page:
https://wordpress.org/plugins/auripath-embed-helper/

WordPress.org SVN repository:
https://plugins.svn.wordpress.org/auripath-embed-helper

## Repository layout

WordPress.org expects this SVN structure:

- trunk/ - current development copy used by WordPress.org
- tags/x.y.z/ - released plugin versions
- assets/ - WordPress.org listing assets

Listing assets go in the top-level assets/ directory, not inside trunk/.

Current asset filenames:

- assets/banner-1544x500.png
- assets/banner-772x250.png
- assets/icon-256x256.png
- assets/icon-128x128.png

## Release checklist

Before publishing a new version:

1. Update the plugin version in auripath-embed-helper.php.
2. Update AURIPATH_EMBED_HELPER_VERSION.
3. Update Stable tag in readme.txt.
4. Add a changelog entry in readme.txt.
5. Test the plugin on a clean WordPress install.
6. Commit changes to GitHub.
7. Copy the release files into WordPress.org SVN trunk/.
8. Create a matching SVN tag under tags/x.y.z/.
9. Commit the SVN release.
10. Check the WordPress.org plugin page and download zip.

## Example SVN release flow

Replace x.y.z with the real version number.

svn checkout https://plugins.svn.wordpress.org/auripath-embed-helper auripath-embed-helper-svn

Copy the GitHub plugin files into SVN trunk, excluding Git-only files.

Then from the SVN checkout:

svn add trunk --force
mkdir -p tags/x.y.z
rsync -av trunk/ tags/x.y.z/
svn add tags/x.y.z --force
svn status
svn commit -m "Release x.y.z"

## WordPress.org assets

To update listing assets, place the new files in the SVN assets/ directory and commit them:

svn add assets --force
svn commit -m "Update WordPress.org plugin listing assets"

WordPress.org may take a little while to refresh the public listing after asset changes.

## Security notes

Do not commit WordPress.org SVN passwords, personal access tokens, local credentials, private server paths, or account recovery details.

SVN credentials are managed through the WordPress.org account security settings.
