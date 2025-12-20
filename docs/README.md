# Tutorial Git - PPDB SMA

## 📥 Git Pull (Ambil Update)
```bash
cd c:\xampp\htdocs\zonasi
git pull origin master
```

## 📤 Git Push (Upload Perubahan)
```bash
git add .
git commit -m "Deskripsi perubahan"
git push origin master
```

## 🔄 Alur Kerja Harian
1. `git pull origin master` - Ambil update
2. Kerjakan perubahan
3. `git add .` - Stage file
4. `git commit -m "pesan"` - Simpan
5. `git push origin master` - Upload

## 📋 Perintah Penting
| Perintah | Fungsi |
|----------|--------|
| `git status` | Cek status |
| `git pull origin master` | Ambil update |
| `git add .` | Stage semua file |
| `git commit -m "pesan"` | Simpan perubahan |
| `git push origin master` | Upload ke GitHub |

## ⚠️ Jika Ada Konflik
```bash
# 1. Cek file konflik
git status

# 2. Edit file, hapus tanda: <<<<<<< ======= >>>>>>>

# 3. Simpan
git add .
git commit -m "Resolve conflicts"
git push origin master
```

## 📁 Info Repository
- **URL:** https://github.com/rifqimaulanaakbar22/PPDBSMA.git
- **Branch:** master
