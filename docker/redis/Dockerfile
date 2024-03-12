FROM redis:6.0-alpine

LABEL Description="ExcelDataUploader redis image fork from redis:6.0-alpine"
LABEL Vendor="ExcelDataUploader"
LABEL Version=1.0

# --------- Server
CMD [ "redis-server", "--appendonly", "yes" ]