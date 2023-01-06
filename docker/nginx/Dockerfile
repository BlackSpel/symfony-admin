FROM nginx:1.23

RUN mkdir -p /etc/nginx/templates

COPY nginx.conf /etc/nginx/
COPY templates/* /etc/nginx/templates/

ARG NGINX_SYMFONY_SERVER_NAME
RUN echo > /etc/nginx/conf.d/default.conf
CMD ["nginx"]

EXPOSE 80
EXPOSE 443
