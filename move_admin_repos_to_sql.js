const fs = require('fs');
const path = require('path');

const adminDir = 'c:/innova/ecommerce/app/Repositories/Admin';
const sqlDir = path.join(adminDir, 'SQL');

if (!fs.existsSync(sqlDir)) {
    fs.mkdirSync(sqlDir, { recursive: true });
}

const files = fs.readdirSync(adminDir).filter(f => f.endsWith('Repository.php'));

for (const file of files) {
    const oldPath = path.join(adminDir, file);
    const newPath = path.join(sqlDir, file);
    
    let content = fs.readFileSync(oldPath, 'utf8');
    content = content.replace('namespace App\\Repositories\\Admin;', 'namespace App\\Repositories\\Admin\\SQL;');
    
    fs.writeFileSync(newPath, content, 'utf8');
    fs.unlinkSync(oldPath);
}

// Update Service Providers
const providers = [
    'c:/innova/ecommerce/app/Providers/RepositoryServiceProvider.php',
    'c:/innova/ecommerce/app/Providers/AppServiceProvider.php'
];

for (const p of providers) {
    if (fs.existsSync(p)) {
        let content = fs.readFileSync(p, 'utf8');
        content = content.replace(/use App\\Repositories\\Admin\\([A-Za-z0-9_]+Repository);/g, 'use App\\Repositories\\Admin\\SQL\\$1;');
        fs.writeFileSync(p, content, 'utf8');
    }
}

console.log('Repositories moved to SQL folder successfully!');
