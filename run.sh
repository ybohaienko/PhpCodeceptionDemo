#!/usr/bin/env bash

usage="$(basename "$0") -- custom e2e framework CLI

usage: sh $(basename "$0") [options] ...

where:
    -h  show this help text
    -l  execute on Linux
    -m  execute on MacOS
"

if [ $# -eq 0 ]; then
    echo "no arguments provided, use -h option for more info"
    exit 1
fi

while getopts ':hlm' option; do
  case "$option" in
    h)  echo "$usage"
        exit
        ;;
    l)  driver=chromedriver_linux
        ;;
    m)  driver=chromedriver_macos
        ;;
    :)  printf "missing argument for -%s\n" "$OPTARG" >&2
        exit 1
        ;;
   \?)  printf "illegal option: -%s\n" "$OPTARG" >&2
        exit 1
        ;;
  esac
done

shift $((OPTIND - 1))

echo_cyan() {
  COLOR='\033[1;96m'
  DROP='\033[0m'
  echo "${COLOR}$1${DROP}"
}

cleanup(){
  echo_cyan "Cleanup..." &&
  kill -13 "$(lsof -i:4444 -t)" > /dev/null 2>&1
  kill -13 "$(lsof -i:9515 -t)" > /dev/null 2>&1
}

cleanup
echo_cyan "Starting Selenium..."
java -jar selenium-server-standalone-3.141.59.jar > /dev/null 2>&1 &
echo_cyan "Starting Chromedriver..." &&
./$driver --url-base=/wd/hub > /dev/null 2>&1 &
sleep 4
php codecept.phar run -g main --debug
