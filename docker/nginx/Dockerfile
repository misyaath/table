FROM nginx:1.23.1-alpine

LABEL Description="ExcelDataUploader Nginx image fork of nginx:1.23.1-alpine"
LABEL Vendor="ExcelDataUploader"
LABEL Version=1.0

ARG EXCEL_DATA_UPLOADER_WORK_DIR=/var/www

COPY ./docker/nginx/ssl/app.portal.test /etc/nginx/ssl
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/templates/portal-ssl.conf.template /etc/nginx/templates/portal.conf.template
COPY ./docker/nginx/custom-entrypoint.sh /docker-entrypoint.d/40-custom-entrypoint.sh

RUN chmod u+x /docker-entrypoint.d/40-custom-entrypoint.sh

RUN rm /etc/nginx/conf.d/default.conf

WORKDIR ${EXCEL_DATA_UPLOADER_WORK_DIR}

CMD ["nginx", "-g", "daemon off;"]