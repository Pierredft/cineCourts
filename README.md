# cineCourts

Bundle installés pour l'authentification avec Google : 

- knpuniversity/oauth2-client-bundle -> bundle d'auth
- league/oauth2-google -> bundle d'auth pour GOOGLE 

pour l'auth a google il faut :
        > SOUS WINDOWS :
Téléchargez cacert.pem depuis le site de cURL. (https://curl.se/docs/caextract.html)
Sauvegardez-le, par exemple, dans C:\php\extras\ssl\cacert.pem.
Ouvrez votre fichier php.ini et mettez à jour les lignes suivantes (elles seront normalement commentées de base) :

        [curl]
        curl.cainfo = "C:\php\extras\ssl\cacert.pem"

        [openssl]
        openssl.cafile = "C:\php\extras\ssl\cacert.pem"


    >SOUS MACOS : 
Pareil.
        [curl]
        curl.cainfo = "/usr/local/etc/openssl@1.1/cert.pem"

        [openssl]
        openssl.cafile = "/usr/local/etc/openssl@1.1/cert.pem"

PUIS REDEMARREZ LE SERVEUR