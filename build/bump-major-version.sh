# check if open-transposh.php file exists
if [ ! -f open-transposh.php ]; then
  cd ../
  if [ ! -f open-transposh.php ]; then
    echo "open-transposh.php file not found"
    exit 1
  fi
fi

# MAJOR version when you make incompatible API changes
deno run --allow-run --allow-read --allow-write build/bump-version.ts major
exit 0;
