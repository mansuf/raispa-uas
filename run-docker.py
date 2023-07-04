import subprocess
import argparse
import secrets

parser = argparse.ArgumentParser()
parser.add_argument('-d', '--daemon', action='store_true')
args = parser.parse_args()

port = '7000'

random_char = secrets.token_hex(5)
name = 'raispa-uas'
container_name = f'{name}-{random_char}'

docker_args = [
    'docker',
    'run',
    '-p',
    f'127.0.0.1:{port}:80',
    '--name',
    container_name
]

if args.daemon:
    docker_args.append('-d')

image = 'raispa-uas'

docker_args.append(image)

app_args = [
    'service',
    'apache2',
    'start'
]

subprocess.run(docker_args + app_args)