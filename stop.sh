echo "[MAIN] Stopping container"
docker ps --filter status=running --filter name=raispa-uas -q | xargs docker stop

# Delete main app container
echo "[MAIN] Removing container"
docker ps --filter status=exited --filter name=raispa-uas -q | xargs docker rm

# Delete main image
echo "[MAIN] Removing image"
docker image rm raispa-uas --force