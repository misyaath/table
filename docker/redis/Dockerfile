FROM redis:6.0-alpine

LABEL Description="table redis image fork from redis:6.0-alpine"
LABEL Vendor="table"
LABEL Version=1.0

# --------- Server
CMD [ "redis-server", "--appendonly", "yes" ]
