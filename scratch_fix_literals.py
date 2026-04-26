import os
import re

repos_dir = 'c:/innova/ecommerce/app/Repositories/Admin'
repos = [f for f in os.listdir(repos_dir) if f.endswith('.php') and f.endswith('Repository.php')]

for r in repos:
    rpath = os.path.join(repos_dir, r)
    with open(rpath, 'r', encoding='utf-8') as f:
        content = f.read()

    original = content
    
    # create
    content = content.replace('public function create(array $1 = []): mixed', 'public function create(array $data = []): mixed')

    # update
    content = content.replace('public function update($1, array $2 = []): mixed', 'public function update($id, array $data = []): mixed')
    content = content.replace('public function update($2, array $1 = []): mixed', 'public function update($id, array $data = []): mixed')

    if content != original:
        with open(rpath, 'w', encoding='utf-8') as f:
            f.write(content)
print('Done!')
