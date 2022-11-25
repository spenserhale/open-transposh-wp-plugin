# check if open-transposh.php file exists
if [ ! -f open-transposh.php ]; then
  cd ../
  if [ ! -f open-transposh.php ]; then
    echo "open-transposh.php file not found"
    exit 1
  fi
fi

# PATCH version when you make backwards compatible bug fixes
deno run --allow-run --allow-read --allow-write build/bump-version.ts patch
exit 0;
