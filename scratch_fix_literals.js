const fs = require('fs');
const path = require('path');

const reposDir = 'c:/innova/ecommerce/app/Repositories/Admin';
const repos = fs.readdirSync(reposDir).filter(f => f.endsWith('Repository.php'));

for (const r of repos) {
    const rpath = path.join(reposDir, r);
    let content = fs.readFileSync(rpath, 'utf8');
    const original = content;

    content = content.replace(/public function create\(array \$1 = \[\]\): mixed/g, 'public function create(array $data = []): mixed');
    content = content.replace(/public function update\(\$1, array \$2 = \[\]\): mixed/g, 'public function update($id, array $data = []): mixed');
    content = content.replace(/public function update\(\$2, array \$1 = \[\]\): mixed/g, 'public function update($id, array $data = []): mixed');

    // Also to be safe, there might be places that use `$user` instead of `$data`? No, since I replaced blindly, let's just make it `$data` since that's what was inside.
    // wait, what about the function body? The function body used the original variable name!
    // Since I only replaced the definition, the body still has whatever it had (like `$data`).
    // So `$data` is mostly correct! Let's check `AdminRepository.php` to see if `$data` is used in the body.
    if (content !== original) {
        fs.writeFileSync(rpath, content, 'utf8');
    }
}
console.log('Fixed literal variables!');
