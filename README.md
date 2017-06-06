# oaf-thematic

OpenAustralia Foundation Wordpress theme based on Thematic.

This is the theme currently running at https://www.openaustraliafoundation.org.au/ .

## Deployment

To deploy code changes to the site you need to ssh into the `jamison` server and user git to pull down changes.

```
ssh you@kedumba.openaustraliafoundation.org.au

ssh you@jamison

cd /var/www/wp-content/themes/oaf-thematic

sudo git fetch

# check if the status is what you expect
git status

# if the changes are what you expect
sudo git pull

# check that the current commit is what you expect it to be
git status
```
